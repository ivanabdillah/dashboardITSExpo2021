<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Instruction;
use App\Models\Invoice;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class CompetitionController extends Controller
{
    public function index()
    {
        $instructions = Instruction::with('competition')->get();
        return view('competition.admin.instruksi')->with('instructions', $instructions);
    }

    public function create()
    {
        $instructions = Instruction::get();
        $competitions = Competition::get();
        return view('competition.admin.instruksi-add')->with([
            'instructions' => $instructions,
            'competitions' => $competitions
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'competition_id' => 'required|exists:competitions,id',
            'dependency_id' => 'nullable|exists:instructions,id'
        ]);

        Instruction::create($data);

        return redirect()->route('admin.instruksi')->with('success', 'Berhasil ditambahkan');
    }

    public function toggle($id)
    {
        $instruction = Instruction::where('id', $id)->firstOrFail();
        $instruction->is_open = !$instruction->is_open;
        $instruction->save();

        if ($instruction->is_open) {
            $msg = 'Berhasil dibuka';
        } else {
            $msg = 'Berhasil ditutup';
        }

        return redirect()->route('admin.instruksi')->with('success', $msg);
    }

    public function edit($id)
    {
        $instruction = Instruction::where('id', $id)->firstOrFail();
        $instructions = Instruction::get();
        $competitions = Competition::get();
        return view('competition.admin.instruksi-edit')->with([
            'instruction' => $instruction,
            'instructions' => $instructions,
            'competitions' => $competitions
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'competition_id' => 'required|exists:competitions,id',
            'dependency_id' => 'nullable|exists:instructions,id'
        ]);

        $instruction = Instruction::where('id', $id)->firstOrFail();
        $instruction->update($data);

        return redirect()->route('admin.instruksi')->with('success', 'Berhasil diperbarui');
    }

    public function destroy($id)
    {
        $instruction = Instruction::where('id', $id)->firstOrFail();
        $instruction->delete();

        return redirect()->route('admin.instruksi')->with('success', 'Berhasil dihapus');
    }

    public function indexPeserta()
    {
        $user = Auth::user()->load('userable.invoice');

        $submission = collect(Submission::where('team_id', $user->userable_id)->get())->keyBy('instruction_id');

        $allInstructions = Instruction::where('competition_id', $user->userable->competition_id)->where('is_open', true)->get();
        $cleanInstructions = [];

        foreach ($allInstructions as $item) {
            if (!$item->dependency_id) {
                array_push($cleanInstructions, $item);
            } else {
                if (isset($submission[$item->dependency_id])) {
                    if ($submission[$item->dependency_id]['status'] == 'lolos') {
                        array_push($cleanInstructions, $item);
                    }
                }
                continue;
            }
        }

        $belumBayar = true;
        if ($user->userable->invoice) {
            if (($user->userable->invoice->approver_id) && ($user->userable->invoice->approved_at)) {
                $belumBayar = false;
            }
        }
        // dd($user->userable->competition->instructions);
        return view('competition.pengguna.submission')->with([
            'belumBayar' => $belumBayar,
            'users' => $user,
            'instructions' => $cleanInstructions,
            'submissions' => $submission
        ]);
    }

    public function submissionAdd(Request $request)
    {
        $data = $request->validate([
            'instruction_id' => 'required|exists:instructions,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'submission' => ['required', 'file', 'mimes:jpg,bmp,png,pdf,zip']
        ]);

        $invoice = Invoice::where('team_id', $request->user()->userable_id)->firstOrFail();

        if (!$invoice or ($invoice && is_null($invoice['approver_id']) && is_null($invoice['approved_at']))) {
            return redirect()->back()->withErrors('Terjadi kesalahan! Tim anda terdeteksi belum diverifikasi pembayarannya');
        }

        $instruction = Instruction::where('id', $data['instruction_id'])->firstOrFail();
        if (!$instruction['is_open']) {
            return redirect()->back()->withErrors('Terjadi kesalahan! Instruksi sudah tidak dibuka');
        }

        $oldSubmission = Submission::where('team_id', $request->user()->userable_id)->where('instruction_id', $data['instruction_id'])->first();
        if ($oldSubmission) {
            $oldSubmission->delete();
        }

        if (!$request->has('submission')) {
            return redirect()->back()->withErrors('Berkas submisi tidak ada');
        } else {
            $submissionName = $request->user()->userable_id . '_' . Carbon::now()->format('Ymd_His') . '.' . $request->file('submission')->getClientOriginalExtension();
            $submissionPath = 'berkas/submission/' . $request->user()->userable_id . '/';
            Storage::putFileAs($submissionPath, $request->file('submission'), $submissionName);

            $submission = new Submission([
                'name' => $data['name'],
                'description' => $data['description'],
                'path' =>  $submissionPath . $submissionName,
                'team_id' => $request->user()->userable_id,
                'instruction_id' => $data['instruction_id']
            ]);

            $submission->save();

            return redirect()->route('pengguna.submission.index')->with('success', 'Berhasil diunggah');
        }
    }

    public function listSubmmission()
    {
        $submissions = Submission::where('team_id', Auth::user()->userable_id)->get();

        return view('competition.pengguna.submission-list')->with('submissions', $submissions);
    }

    public function berkasSubmission(Request $request)
    {
        $request->validate([
            'berkas' => 'required'
        ]);

        $path = $request->berkas;

        if (File::isDirectory(storage_path('app/' . $path))) {
            return Storage::disk('local')->response(Storage::disk('local')->files($path)[0]);
        } else if (File::isFile(storage_path('app/' . $path))) {
            return Storage::disk('local')->response($path);
        }

        return redirect()->back()->withErrors('Berkas tidak ditemukan');
    }

    public function indexAdmin($id = null)
    {
        $instructions = Instruction::get();
        $submission = Submission::with('team.competition')->where('instruction_id', $id)->get();
        return view('competition.admin.submission')->with([
            'id' => $id,
            'instructions' => $instructions,
            'submission' => $submission
        ]);
    }

    public function loloskan($submissionId, $id)
    {
        $submission = Submission::where('id', $submissionId)->firstOrFail();

        $submission->status = 'lolos';
        $submission->save();

        return redirect()->route('admin.submission.index', $id)->with('success', 'Berhasil diloloskan');
    }

    public function tidakLoloskan($submissionId, $id)
    {
        $submission = Submission::where('id', $submissionId)->firstOrFail();

        $submission->status = 'tidak lolos';
        $submission->save();

        return redirect()->route('admin.submission.index', $id)->with('success', 'Berhasil tidak diloloskan');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class PembayaranController extends Controller
{
    public function halamanPembayaran()
    {
        $invoice = Invoice::where('team_id', Auth::user()->userable_id)->with('team.competition', 'promo')->first();
        if (!$invoice) {
            $invoice = new Invoice([
                'team_id' => Auth::user()->userable_id
            ]);
            $invoice->save();
            $invoice->load('team.competition', 'promo');
        }

        return view('pembayaran.peserta.index')->with('invoice', $invoice);
    }

    public function cekPromo(Request $request)
    {
        $request->validate(['kode_promo' => ['required']]);
        $promo = Promo::where('name', $request->kode_promo)
            ->whereDate('start', '<=', Carbon::now())
            ->whereDate('end', '>=', Carbon::now())
            ->first();

        if ($promo) {
            $invoice = Invoice::where('team_id', $request->user()->userable_id)->firstOrFail();
            $invoice->promo_id = $promo->id;
            $invoice->save();
            return redirect()->route('pengguna.pembayaran')->with('success', 'Kode promo berhasil diterapkan');
        }
        return redirect()->route('pengguna.pembayaran')->withErrors('Kode promo tidak ditemukan atau sudah kadaluarsa');
    }

    public function unggahBukti(Request $request)
    {
        $request->validate([
            'bukti_bayar' => ['required', 'file', 'mimes:jpg,bmp,png,pdf']
        ]);
        $user = $request->user()->load('userable.competition', 'userable.invoice');
        $invoice = $user->userable->invoice;
        if ($invoice) {
            if ($invoice['approver_id'] and $invoice['approved_at']) return redirect()->route('pengguna.pembayaran')->withErrors('Pembayaranmu telah dikonfirmasi');
            if ($invoice->payment_proof) Storage::delete($invoice->payment_proof);

            $buktiName = $request->user()->userable_id . '_' . Carbon::now()->format('Ymd_His') . '.' . $request->file('bukti_bayar')->getClientOriginalExtension();
            $buktiPath = 'images/bukti_bayar/' . $request->user()->userable_id . '/';
            Storage::putFileAs($buktiPath, $request->file('bukti_bayar'), $buktiName);
            $invoice->payment_proof = $buktiPath . $buktiName;
            $invoice->payment_timestamp = Carbon::now();
            $invoice->save();

            return redirect()->route('pengguna.pembayaran')->with('success', 'Bukti berhasil diunggah');
        }

        return redirect()->route('pengguna.pembayaran')->withErrors('Terjadi kesalahan tidak diketahui');
    }

    public function halamanVerifikasi($filter = null)
    {
        if ($filter) {
        } else {
            $invoices = Invoice::with('team.competition')->get();
        }
        return view('pembayaran.admin.index')->with(['invoices' => $invoices, 'filter' => $filter]);
    }

    public function verifPembayaran(Request $request, $id)
    {
        $invoice = Invoice::where('id', $id)->firstOrFail();
        $invoice->approver_id = $request->user()->userable_id;
        $invoice->approved_at = Carbon::now();
        $invoice->save();

        return redirect()->route('admin.pembayaran')->with('success', 'Berhasil di verifikasi');
    }

    public function tolakPembayaran()
    {
    }

    public function berkasBukti(Request $request, $id)
    {
        $invoice = Invoice::where('team_id', $id)->firstOrFail();
        return Storage::response($invoice->payment_proof);
    }
}

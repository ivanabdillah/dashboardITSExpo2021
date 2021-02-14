<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Competition;
use App\Models\TeamProfile;
use App\Models\TeamMember;
use Throwable;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showRegistrationForm()
    {
        $competitions = Competition::get();
        return view('auth.register')->with('competitions', $competitions);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'college_name' => ['required', 'string', 'max:255'],
            'team_name' => ['required', 'string', 'max:255'],
            'competition_id' => ['required', 'string', 'max:255', 'exists:competitions,id'],
            'leader_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'line_id' => ['nullable', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {
            $ketua = new TeamMember([
                'name' => $data['leader_name'],
                'phone' => $data['phone_number'],
                'line_id' => $data['line_id']
            ]);
            $ketua->save();

            $teams = new TeamProfile([
                'team_name' => $data['team_name'],
                'college_name' => $data['college_name'],
                'ketua_id' => $ketua['id'],
                'competition_id' => $data['competition_id']
            ]);
            $teams->save();
            DB::commit();
            return User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => 1,
                'userable_id' => $teams['id'],
                'userable_type' => \App\Models\TeamProfile::class
            ]);
        } catch (Throwable $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

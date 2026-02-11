<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use App\Mail\SendForgetMail;
use Hash;
use Illuminate\Support\Str;

class ResetPasswordComponent extends Component
{
    public $token;

    public function mount($id)
    {
        $this->token = $id;

        $check = DB::table('password_reset_tokens')->where('token', $id)->first();
        if(!$check) {
                session()->flash('error', 'Invalid token!');
                return redirect()->route('forget.password');
        }
     }

    public function render()
    {
        $data = DB::table('password_reset_tokens')->where('token' , $this->token)->first();
        return view('livewire.auth.reset-password-component', compact('data'))->layout('layouts.auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = DB::table('password_reset_tokens')->where(['email' => $request->email, 'token' => $request->token])->first();
        if(!$user){
            session()->flash('error', 'Invalid token!');
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        session()->flash('success', 'our password has been changed!');
        return redirect()->route('login');
    }
}

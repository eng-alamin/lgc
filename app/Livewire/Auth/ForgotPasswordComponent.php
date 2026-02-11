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

class ForgotPasswordComponent extends Component
{
    public function mount()
    {
        $five = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        DB::table('password_reset_tokens')->where('created_at', '<=', $five)->delete();
    }
    public function render()
    {
        return view('livewire.auth.forgot-password-component')->layout('layouts.auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        $check = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if(!$check) {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
                ]);

            $maildata = [
                'title' => 'Reset Password',
                'content' => 'You can reset password from bellow link:',
                'token' => $token
            ];

            Mail::to($request->email)->send(new SendForgetMail($maildata));

            session()->flash('success', 'We have e-mailed your password reset link! Expire 5 minutes');
            return redirect()->route('forget.password');
        }else{
            session()->flash('error', 'Already, We have e-mailed your password reset link!');
            return redirect()->route('forget.password');
        }

    }
}

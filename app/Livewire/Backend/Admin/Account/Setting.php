<?php

namespace App\Livewire\Backend\Admin\Account;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use DB;

class Setting extends Component
{
    public function render()
    {
        $data = User::findOrFail(auth()->id());

        return view('livewire.backend.admin.account.setting', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Setting | Let's Go China",
        ]);
    }

    public function updateSetting(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        try{
            $data = User::find($id);

            if($request->avatar) {
                $fileName = time().'.'.$request->avatar->extension();
                $path = $request->avatar->storeAs('avatar', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $data->avatar = $fileData;
            }
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->save();


            // Log the activity
            activity()
            ->useLog('account')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The account is updated for information.");

            return redirect()->route('admin.account.setting')->with('success', 'Account updated successfully');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Account updated failed: ' . $e->getMessage());
        }
    }

    public function updateEmail(Request $request)
    {
        $data = Auth::user();

        $request->validate([
            'password' => 'required',
            'email' => 'required|email|unique:users,email,' . $data->id,
        ]);

        if (Hash::check($request->password, $data->password)) {
            $data->email = $request->email;
            $data->email_verified_at = NULL;
            $data->save();

            // $request->user()->sendEmailVerificationNotification();

            // Log the activity
            activity()
            ->useLog('account')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The account is updated for email.");

            return redirect()->route('admin.account.setting')->with('success', 'Email updated successfully.');
        }

        return redirect()->route('admin.account.setting')->with('error', 'Incorrect password.');
    }

    public function updatePassword(Request $request)
    {
        $data = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($request->current_password, $data->password)) {
            $data->password = Hash::make($request->password);
            $data->save();

            // Log the activity
            activity()
            ->useLog('account')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The account is updated for password.");

            return redirect()->route('admin.account.setting')->with('success', 'Password updated successfully.');
        }

        return redirect()->route('admin.account.setting')->with('error', 'Incorrect password.');
    }

    public function deactivate(Request $request)
    {
        $request->validate([
            'deactivate' => 'required',
        ]);

        $data = Auth::user();
        $data->account_status = 2;
        $data->update();
        
        // Log the activity
        activity()
        ->useLog('account')
        ->event('updated')
        ->performedOn($data)
        ->causedBy(auth()->user())
        ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
        ->log("The account is updated for deactivated.");

        Auth::logout();

        return redirect()->route('home')->with('success', 'Your account has been deactivated.');
    }
}

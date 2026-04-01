<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class Setting extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        $data = User::findOrFail($this->user->id);

        return view('livewire.backend.admin.user.setting', [
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
            'email' => 'required',
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
            $data->email = $request->email;
            $data->save();


            // Log the activity
            activity()
            ->useLog('user')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The user is updated for information.");

            return redirect()->route('admin.user.setting', $id)->with('success', 'User updated successfully');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'User updated failed: ' . $e->getMessage());
        }
    }

    public function updatePassword(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $data = User::find($id);
        $data->password = Hash::make($request->password);
        $data->save();

        // Log the activity
        activity()
        ->useLog('user')
        ->event('updated')
        ->performedOn($data)
        ->causedBy(auth()->user())
        ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
        ->log("The user is updated for password.");

        return redirect()->route('admin.user.setting', $id)->with('success', 'Password updated successfully.');
        
    }

    public function deactivate(Request $request, string $id)
    {
        $request->validate([
            'account_status' => 'required',
        ]);

        $data = User::find($id);
        $data->account_status = $request->account_status;
        $data->update();
        
        // Log the activity
        activity()
        ->useLog('user')
        ->event('updated')
        ->performedOn($data)
        ->causedBy(auth()->user())
        ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
        ->log("The user is updated for status.");

        return redirect()->route('admin.user.setting', $id)->with('success', 'Your user has been status.');
    }
}

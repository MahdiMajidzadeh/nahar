<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    public function loginSubmit(Request $request)
    {
        $mobile = $request->get('mobile');
        $password = $request->get('password');

        $user = User::where('mobile', $mobile)->first();

        if($user) {
            if ($user->password == Hash::make($password)) {
                Auth::login($user, true);

                return redirect('dashboard');
            }
        }

        return redirect()->back()->with('msg-error', __('msg.login_wrong'));
    }
}

<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    public static function login($request): bool
    {
        $credentials = $request->only(['username', 'password']);
        return Auth::attempt($credentials);
    }

    public static function register($request): bool
    {
        $reflink = $request->reflink;
        if (empty($reflink)) {
            session()->flash('mgs_error', 'You need a referral link to create a new account.');
            return false;
        }

        $userRef = User::whereReflink($reflink)->first();
        if (empty($userRef)) {
            session()->flash('mgs_error', 'Reflink does not exist on the system!');
            return false;
        }

        if ($userRef->is_admin) {
            session()->flash('mgs_error', 'Reflink Reflink can\'t be admin!');
            return false;
        }

        do {
            $newReflink = Str::random(8);
        } while (User::whereReflink($newReflink)->first() !== null);

        DB::beginTransaction();
        try {
            $password = Hash::make($request->password);
            $user = ModelService::insert(User::class, [
                'email' => $request->email,
                'username' => $request->username,
                'password' => $password,
                'upline_by' => $reflink,
                'reflink' => $newReflink
            ]);
            if ($user === false) {
                DB::rollBack();
                session()->flash('mgs_error', 'New account creation failed!');
                return false;
            }
            $userInfo = ModelService::insert(UserInfo::class, [
                'user_id' => $user->id,
                'fullname' => $request->fullname,
                'phone' => $request->phone
            ]);
            if ($userInfo === false) {
                DB::rollBack();
                session()->flash('mgs_error', 'New account creation failed!');
                return false;
            }
            session()->flash('mgs_success', 'Create account success. Please log in again!');
            DB::commit();
            return true;
        } catch (Exception $exception) {
            logger($exception->getMessage());
            DB::rollBack();
            session()->flash('mgs_error', 'There was a fatal error! Please report to Admin to be handled!');
            return false;
        }
    }

    public static function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}

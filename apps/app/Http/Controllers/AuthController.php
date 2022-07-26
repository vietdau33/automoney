<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(): Factory|View|Application
    {
        return view('auth.login');
    }

    public function loginPost(LoginRequest $request): RedirectResponse
    {
        if (AuthService::login($request)) {
            return redirect()->to(RouteServiceProvider::HOME);
        }
        session()->flash('mgs_error', 'Username or Password not correct!');
        return redirect()->back()->withInput();
    }

    public function register($reflink = null): Factory|View|Application|RedirectResponse
    {
        if (is_null($reflink)) {
            session()->flash('mgs_error', 'You need a referral link to create a new account.');
            return redirect()->route('auth.login');
        }
        return view('auth.register', compact('reflink'));
    }

    public function registerPost(RegisterRequest $request): RedirectResponse
    {
        if (AuthService::register($request)) {
            return redirect()->route('auth.login');
        }
        return back()->withInput();
    }
}

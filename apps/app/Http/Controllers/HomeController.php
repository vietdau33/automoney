<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(): Factory|View|Application
    {
        session()->flash('menu-active', 'dashboard');
        return view('home.index');
    }

    public function listMember(): Factory|View|Application
    {
        session()->flash('menu-active', 'list-member');
        $listUsers = UserService::getListUsers();
        return view('list-member.index', compact('listUsers'));
    }

    public function walletMember(): Factory|View|Application
    {
        session()->flash('menu-active', 'wallet-member');
        $users = UserService::getListPaginateUsers();
        return view('wallet-member.index', compact('users'));
    }

    public function walletMemberEdit(Request $request): JsonResponse
    {
        if(user()->is_user) {
            return jsonError('You not an admin!');
        }
        return UserService::editAddressWallet($request);
    }

    public function reports(): Factory|View|Application
    {
        session()->flash('menu-active', 'report');
        return view('report.index');
    }
}

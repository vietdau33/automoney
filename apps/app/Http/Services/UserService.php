<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public static function getListUsers () {
        $listUsers = User::with(['info', 'sponsor'])->whereRole('user');
        $user = user();

        if (user()->is_user) {
            $listUsers->where(function($query) use ($user) {
                $query->where('level', '>', $user->level);
                $query->where('level', '<=', $user->level + 7);
            });
        }

        $request = request();
        if (!empty($request->username)) {
            $listUsers->where('username', 'like', '%' . $request->username . '%');
        }

        if(!empty($request->date_from)) {
            $listUsers->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }

        if(!empty($request->date_to)) {
            $listUsers->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }

        return $listUsers->orderBy('level')->get()->map(function($u) use ($user) {
            $u->level -= $user->level;
            return $u;
        })->groupBy('level')->toArray();
    }
}

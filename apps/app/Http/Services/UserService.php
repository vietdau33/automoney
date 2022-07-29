<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
{
    public static function getListUsers()
    {
        $listUsers = User::with(['info', 'sponsor'])->whereRole('user');
        $user = user();

        if (user()->is_user) {
            $listUsers->where(function ($query) use ($user) {
                $query->where('level', '>', $user->level);
                $query->where('level', '<=', $user->level + 7);
            });
        }

        self::setSearchQuery($listUsers);

        return $listUsers->orderBy('level')->get()->map(function ($u) use ($user) {
            $u->level -= $user->level;
            return $u;
        })->groupBy('level')->toArray();
    }

    public static function getListPaginateUsers($paginate = 5)
    {
        $users = User::whereRole('user');
        self::setSearchQuery($users);
        return $users->paginate($paginate);
    }

    public static function setSearchQuery(&$query): void
    {
        $request = request();
        if (!empty($request->username)) {
            $query->where('username', 'like', '%' . $request->username . '%');
        }

        if (!empty($request->date_from)) {
            $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }

        if (!empty($request->date_to)) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }
    }

    public static function editAddressWallet($request): JsonResponse
    {
        if (empty($request->address_wallet)) {
            return jsonError('Address Wallet cannot empty!');
        }
        $userEdit = User::find($request->userid);
        if ($userEdit == null) {
            return jsonError('User edit not found!');
        }
        $userInfo = $userEdit->info;
        $userInfo->address_wallet = $request->address_wallet;

        DB::beginTransaction();
        try {
            $userInfo->save();
            DB::commit();
            return jsonSuccess('Edit Address Wallet success!');
        } catch (Exception $exception) {
            logger($exception);
            DB::rollBack();
            return jsonError('Edit Address Wallet error!');
        }
    }
}

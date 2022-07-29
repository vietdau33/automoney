<?php

namespace App\Models;

use App\Http\Services\UserService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositLogs extends Model
{
    use HasFactory;

    protected $table = 'deposit_logs';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getLogs($paginate = 20)
    {
        if (user()->is_admin) {
            $logs = self::where('id', '>', 0);
        } else {
            $logs = self::whereUserId(user()->id);
        }
        UserService::setSearchQuery($logs);
        return $logs->paginate($paginate);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info(): BelongsTo
    {
        return $this->belongsTo(UserInfo::class, 'id', 'user_id');
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'upline_by', 'reflink');
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(UserWallet::class, 'id', 'user_id');
    }

    public function getIsAdminAttribute(): bool
    {
        return $this->role == 'admin';
    }

    public function getIsUserAttribute(): bool
    {
        return $this->role == 'user';
    }

    public function getReflinkAttribute() {
        $reflink = $this->attributes['reflink'];
        if ($this->is_user) {
            return $reflink;
        }
        $idRefAdmin = config('global.id_ref_admin', $this->id);
        if($idRefAdmin == $this->id) {
            return $reflink;
        }
        $userRef = self::find($idRefAdmin);
        return is_null($userRef) ? $reflink : $userRef->reflink;
    }
}

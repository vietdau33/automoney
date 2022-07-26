<?php

use App\Http\Services\ModelService;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

return new class extends Migration
{
    const ADMIN_REF = 'ADMINREF';

    public function __construct()
    {
        $this->domain = env('APP_DOMAIN', 'local.host');
        $this->faker = Faker::create('en');
        $this->ref = [self::ADMIN_REF];
    }

    public function up(): void
    {
        $this->createAdminAccount();
        $this->createAccount1To6();
    }

    private function createAdminAccount(): void
    {
        $admin = [
            'email' => 'admin@' . $this->domain,
            'username' => 'admin',
            'password' => Hash::make('admin1'),
            'reflink' => 'ADMINREF',
            'role' => 'admin'
        ];
        $adminInfo = [
            'fullname' => 'Administator',
            'phone' => '0123456780'
        ];
        $this->createUserAccount($admin, $adminInfo);
    }

    private function createAccount1To6() {
        $defaultPassword = Hash::make('12345678');

        for ($i = 1; $i <= 6; $i++) {
            do {
                $newRef = Str::random(8);
            } while (in_array($newRef, $this->ref));

            $user = [
                'email' => $this->faker->username . '@' . $this->domain,
                'username' => $this->faker->username,
                'password' => $defaultPassword,
                'reflink' => $newRef,
                'upline_by' => end($this->ref)
            ];

            $userInfo = [
                'fullname' => $this->faker->name,
                'phone' => '012345678' . $i
            ];

            $this->createUserAccount($user, $userInfo);

            $this->ref[] = $newRef;
        }
    }

    private function createUserAccount($user, $info) {
        $newUser = ModelService::insert(User::class, $user);
        if($newUser === false) {
            dd('Create User error');
        }
        $newUserInfo = ModelService::insert(UserInfo::class, [
            'user_id' => $newUser->id,
            ...$info
        ]);
        if($newUserInfo === false) {
            dd('Create User Info error');
        }
    }
};

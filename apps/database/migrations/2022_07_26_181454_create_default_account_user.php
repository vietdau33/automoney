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
    const ADMIN_PHONE = '01234556789';

    public function __construct()
    {
        $this->domain = env('APP_DOMAIN', 'local.host');
        $this->faker = Faker::create();
        $this->ref = [self::ADMIN_REF];
        $this->phone = [self::ADMIN_PHONE];
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
            'role' => 'admin',
            'is_active' => 1,
        ];
        $adminInfo = [
            'fullname' => 'Administator',
            'phone' => self::ADMIN_PHONE
        ];
        $this->createUserAccount($admin, $adminInfo);
    }

    private function createAccount1To6() {
        $defaultPassword = Hash::make('12345678');

        for ($i = 1; $i <= 10; $i++) {
            do {
                $newRef = Str::random(8);
            } while (in_array($newRef, $this->ref));

            $user = [
                'email' => $this->faker->username . '@' . $this->domain,
                'username' => $this->faker->username,
                'password' => $defaultPassword,
                'reflink' => $newRef,
                'upline_by' => end($this->ref),
                'level' => $i
            ];

            do {
                $newPhone = $this->faker->numerify('0123#######');
            } while (in_array($newPhone, $this->phone));

            $userInfo = [
                'fullname' => $this->faker->name,
                'phone' => $newPhone
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

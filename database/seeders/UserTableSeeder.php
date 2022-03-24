<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Super Admin';
        $user->email_verified_at = now();
        $user->email = "user1@user.com";
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->save();

        $account = new Account();
        $account->user_id = $user->id;
        $account->account_no = date('ym').rand(1000,9999);
        $account->save();


        $user = new User();
        $user->name = 'User 02';
        $user->email_verified_at = now();
        $user->email = "user2@user.com";
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->save();

        $account = new Account();
        $account->user_id = $user->id;
        $account->account_no = date('ym').rand(1000,9999);
        $account->save();

        $user = new User();
        $user->name = 'User 03';
        $user->email_verified_at = now();
        $user->email = "user3@user.com";
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->save();

        $account = new Account();
        $account->user_id = $user->id;
        $account->account_no = date('ym').rand(1000,9999);
        $account->save();

    }
}

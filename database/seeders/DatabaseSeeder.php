<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $admin = new User();
        $admin->id=1;
        $admin->name='Admin';
        $admin->email='admin@admin.com';
        $admin->email_verified_at = now();
        $admin->password = Hash::make('1234');
        $admin->isAdmin = true;
        $admin->isUser = null;
        $admin->remember_token = Str::random(10);
        $admin->save();
    }
}

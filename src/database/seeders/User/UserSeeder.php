<?php

namespace Database\Seeders\User;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder {

    public function run(): void {
        User::create([
            'user_id' => 'system',
            'user_pw' => Hash::make( 'tltmxpa' ),
            'user_name' => '시스템관리자',
            'user_type' => 'admin',
            'user_level' => 0,
        ]);

        User::create([
            'user_id' => 'admin',
            'user_pw' => Hash::make( 'admin123' ),
            'user_name' => '관리자',
            'user_type' => 'admin',
            'user_level' => 1,
        ]);

        User::factory()
            ->count(5)
            ->state( new Sequence(
                fn( Sequence $sequence ) => ['user_id' => 'user' . ($sequence->index + 1)],
            ))
            ->create();
    }
}

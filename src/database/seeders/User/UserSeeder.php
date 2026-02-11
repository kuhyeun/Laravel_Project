<?php

namespace Database\Seeders\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder {

    public function run(): void {
        User::factory()
            ->count(5)
            ->state( new Sequence(
                fn( Sequence $sequence ) => ['USER_ID' => 'test' . ($sequence->index + 1)],
            ))
            ->create();
    }
}

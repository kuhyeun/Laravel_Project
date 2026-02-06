<?php

namespace Database\Seeders\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder {

    public function run( $count ): void {
        User::factory( $count )->create();
    }
}

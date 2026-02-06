<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User\User;

class UserFactory extends Factory {
    protected $model = User::class;

    public function definition(): array {
        return [
            'USER_ID'    => $this->faker->unique()->userName(),
            'USER_PW'    => Hash::make( 'test123' ),
            'USER_NAME'  => $this->faker->unique()->name(),
            'USER_TYPE'  => 'user',
            'USER_LEVEL' => 99,
            'IS_USE'     => true
        ];
    }
}




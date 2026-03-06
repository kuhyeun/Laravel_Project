<?php

namespace Database\Factories\Menu;

use App\Models\Menu\MenuOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu\MenuOption>
 */
class MenuOptionFactory extends Factory {

    protected $model = MenuOption::class;

    public function definition(): array {
        return [
            // menu_idx는 관계를 통해 자동으로 채워집니다.
            'user_level' => $this->faker->numberBetween(1, 9),
            'menu_sort' => $this->faker->randomDigitNotNull,
            'create_account_idx' => 1, // 임시 관리자 계정 IDX
        ];
    }
}
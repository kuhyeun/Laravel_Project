<?php

namespace MesCore\Database\Factories\Menu;

use Illuminate\Database\Eloquent\Factories\Factory;
use MesCore\Menu\Models\MenuOption;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\MesCore\Menu\Models\MenuOption>
 */
class MenuOptionFactory extends Factory {

    protected $model = MenuOption::class;

    public function definition(): array {
        return [
            'user_level' => $this->faker->numberBetween(1, 9),
            'menu_sort' => $this->faker->randomDigitNotNull,
            'create_account_idx' => 1,
        ];
    }
}

<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model {
    use HasFactory;

    protected $table = 'system_menu';
    protected $primaryKey = 'menu_idx';
    public $incrementing = true;

    const CREATED_AT = 'create_datetime';
    const UPDATED_AT = 'update_datetime';

    public function menuOptions(): HasMany {
        return $this->hasMany(MenuOption::class, 'menu_idx', 'menu_idx');
    }
}

<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuOption extends Model {
    use HasFactory;

    protected $table = 'system_menu_option';
    protected $primaryKey = 'menu_option_idx';
    public $incrementing = true;

    const CREATED_AT = 'create_datetime';
    const UPDATED_AT = 'update_datetime';

    public function menu(): BelongsTo {
        return $this->belongsTo(Menu::class, 'menu_idx', 'menu_idx');
    }
}
<?php

namespace MesCore\Menu\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use MesCore\Database\Factories\Menu\MenuFactory;

class Menu extends Model {
    use HasFactory;

    protected static function newFactory() {
        return MenuFactory::new();
    }

    protected $table = 'system_menu';
    protected $primaryKey = 'menu_idx';
    public $incrementing = true;
    protected $fillable = [
        'menu_name',
        'menu_code',
        'parent_menu_code',
        'top_menu_code',
        'menu_depth',
        'module_code',
        'menu_route_name',
        'is_use',
        'is_display',
        'is_admin',
        'create_account_idx',
        'update_account_idx',
        'remark',
    ];
    protected $attributes = [
        'is_use' => 'Y',
        'is_display' => 'Y'
    ];

    const CREATED_AT = 'create_datetime';
    const UPDATED_AT = 'update_datetime';

    public static function validateMenuData(): array {
        return [
            'menu_code'        => 'required|string|max:30|unique:system_menu,menu_code',
            'top_menu_code'    => 'required|string|max:30',
            'parent_menu_code' => 'nullable|string|max:30|exists:system_menu,menu_code',
            'menu_name'        => 'required|string|max:50',
            'menu_depth'       => 'required|integer|min:1',
            'menu_route_name'  => 'nullable|string|max:50',
            'is_use'           => 'sometimes|in:Y,N',
            'is_display'       => 'sometimes|in:Y,N',
            'remark'           => 'nullable|string',
        ];
    }

    public static function createUserMenu(Request $request): self {
        $validatedData = $request->validate(self::validateMenuData());

        return DB::transaction(function () use ($validatedData) {
            $menu = static::create(array_merge($validatedData, [
                'is_admin' => 'N',
                'create_account_idx' => Auth::id()
            ]));

            $menu->menuOptions()->createMany([
                ['menu_level' => 0, 'menu_sort' => 99, 'create_account_idx' => Auth::id()],
                ['menu_level' => 1, 'menu_sort' => 99, 'create_account_idx' => Auth::id()],
                ['menu_level' => 10, 'menu_sort' => 99, 'create_account_idx' => Auth::id()],
                ['menu_level' => 99, 'menu_sort' => 99, 'create_account_idx' => Auth::id()],
            ]);

            return $menu;
        });
    }

    public static function createAdminMenu(Request $request): self {
        $validatedData = $request->validate(self::validateMenuData());

        return DB::transaction(function () use ($validatedData) {
            $menu = static::create(array_merge($validatedData, [
                'is_admin' => 'Y',
                'create_account_idx' => Auth::id()
            ]));

            $menu->menuOptions()->createMany([
                ['menu_level' => 0, 'menu_sort' => 99, 'create_account_idx' => Auth::id()],
                ['menu_level' => 1, 'menu_sort' => 99, 'create_account_idx' => Auth::id()],
            ]);

            return $menu;
        });
    }

    public function menuOptions(): HasMany {
        return $this->hasMany(MenuOption::class, 'menu_idx', 'menu_idx');
    }
}

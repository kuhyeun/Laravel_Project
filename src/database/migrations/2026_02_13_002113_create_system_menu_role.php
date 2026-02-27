<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('system_menu_option', function (Blueprint $table) {
            $table->string('menu_code', 30)->comment('메뉴 코드');
            $table->integer('user_level')->comment('사용자 권한레벨');
            $table->integer('menu_sort')->comment('메뉴 정렬순서');
            $table->integer('create_account_idx')->comment('등록자');
            $table->timestamp('create_datetime')->comment('등록일');
            $table->comment('메뉴 설정 ( 권한 및 순서 )');
        });
    }

    public function down(): void {
        Schema::dropIfExists('system_menu_role');
    }
};
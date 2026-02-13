<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory;

    const CREATED_AT = 'create_datetime'; // 실제 생성 시각 컬럼 이름 지정
    const UPDATED_AT = 'update_datetime'; // 실제 업데이트 시각 컬럼 이름 지정

    protected $table      = 'account_member'; // 로그인/인증시 사용될 테이블 이름 재정의 ( 기본값 : users )
    protected $primaryKey = 'account_idx'; // 기본 키 컬럼 ( 기본값 : user_idx )
    public $incrementing  = true; // PK의 AutoIncrement 여부

    // 계정 추가/등록시 입력될 컬럼 정보
    protected $fillable = [
        'user_id',
        'user_pw',
        'user_level',
        'is_use',
        'create_account_idx', // 옵저버로 채워질 감사 컬럼
        'update_account_idx', // 옵저버로 채워질 감사 컬럼
    ];

    // 조회시 숨겨져야될 컬럼 ( Select를 해도 user_pw 는 조회되지않음 )
    protected $hidden = [
        'user_pw',
    ];

    protected function casts(): array {
        return [
            'user_pw' => 'hashed', // 비밀번호 컬럼은 반드시 hashed 캐스팅
            'is_use' => 'boolean', // 필요하다면 불리언으로 캐스팅 ( 값이 Y/N or 0/1 이어도 true false 로 반환시켜줌 - 지리는 기능 )
            'create_datetime' => 'datetime', // 자동 타임스탬프 컬럼도 캐스팅 적용 (Carbon 객체로 사용)
            'update_datetime' => 'datetime', // 자동 타임스탬프 컬럼도 캐스팅 적용 (Carbon 객체로 사용)
        ];
    }

    public $timestamps = true; // Laravel의 타임스탬프 자동 관리 활성화

    // Laravel 인증시 사용할 id 값의 컬럼명 재정의 ( 기본값은 email )
    public function username(): string {
        return 'user_id';
    }

    // Laravel 인증시 비교할 암호화된 password 값의 컬럼명 재정의 ( 기본값은 password )
    public function getAuthPassword(): string {
        return $this->user_pw;
    }
}
<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Model 대신 Authenticatable 상속
use Illuminate\Notifications\Notifiable; // Notifiable 트레잇도 로그인 가능한 모델에 유용할 수 있습니다.

class Login extends Authenticatable {
    use HasFactory, Notifiable;

    const CREATED_AT = 'CREATE_DATETIME'; // 실제 생성 시각 컬럼 이름 지정
    const UPDATED_AT = 'UPDATE_DATETIME'; // 실제 업데이트 시각 컬럼 이름 지정

    protected $table = 'account_member'; // 요청하신 테이블 이름
    protected $primaryKey = 'ACCOUNT_IDX'; // 요청하신 기본 키 컬럼
    public $incrementing = true; // ACCOUNT_IDX가 자동 증가 컬럼이라고 가정

    /**
     * 대량 할당이 가능한 속성입니다.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'USER_ID',
        'USER_PW',
        'USER_LEVEL',
        'IS_USE',
        'CREATE_ACCOUNT_IDX', // 옵저버로 채워질 감사 컬럼
        'UPDATE_ACCOUNT_IDX', // 옵저버로 채워질 감사 컬럼
    ];

    // 조회시 숨겨져야될 컬럼
    protected $hidden = [
        'USER_PW',
    ];

    protected function casts(): array {
        return [
            'USER_PW' => 'hashed', // 비밀번호 컬럼은 반드시 hashed 캐스팅
            'IS_USE' => 'boolean', // 필요하다면 불리언으로 캐스팅 ( 값이 Y/N or 0/1 이어도 true false 로 반환시켜줌 )
            'CREATE_DATETIME' => 'datetime', // 자동 타임스탬프 컬럼도 캐스팅 적용 (Carbon 객체로 사용)
            'UPDATE_DATETIME' => 'datetime', // 자동 타임스탬프 컬럼도 캐스팅 적용 (Carbon 객체로 사용)
        ];
    }

    public $timestamps = true; // Laravel의 타임스탬프 자동 관리 활성화
}
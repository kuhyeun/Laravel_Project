
-- laravel 설치 11버전
docker compose exec php composer create-project laravel/laravel:^11.0 .

-- composer.json 업데이트 버전 고정
"require": {
  "laravel/framework": "^11.0"
}

How to Install Distribution Project

1.  Docker 컨테이너 빌드 및 백그라운드 실행:
      docker-compose up -d --build
    
2.  Composer 의존성 설치:
      docker-compose exec php composer install
    
3.  Laravel 애플리케이션 키 생성:
    *   .env 파일의 APP_KEY 값을 새로 생성하여 애플리케이션을 보호합니다. (이미 키가 있더라도 새로 생성하는 것이 안전합니다.)
      
      docker-compose exec php php artisan key:generate
    
4.  데이터베이스 마이그레이션 실행:
    *   Laravel의 database/migrations에 정의된 테이블들을 mysql 컨테이너의 데이터베이스에 생성합니다.
      
      docker-compose exec php php artisan migrate
    *   (선택 사항) 만약 시드 데이터(테스트용 초기 데이터)도 추가하고 싶다면 아래 명령어를 사용하세요.
      
      docker-compose exec php php artisan db:seed
    
5.  Vite 사용 시 프론트엔드 의존성 설치:
    *   package.json 파일이 있다면 아래 명령어를 실행하여 Node.js 패키지를 설치해야 합니다.
      
      docker-compose exec php npm install

6.  로컬 개발환경을 위해 vendor/node_modules 폴더 로컬로 복사 및 생성:
    *   docker cp php:/var/www/html/vendor ./src/vendor
    *   npm install
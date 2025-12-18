
-- laravel 설치 11버전
docker compose exec php composer create-project laravel/laravel:^11.0 .

-- composer.json 업데이트 버전 고정
"require": {
  "laravel/framework": "^11.0"
}

#!/bin/bash

# packages 디렉토리에서 node_modules를 찾을 수 있도록 심볼릭 링크 생성
ln -sfn /var/www/html/node_modules /var/www/packages/node_modules 2>/dev/null

# 기본 명령 실행 (php-fpm)
exec "$@"

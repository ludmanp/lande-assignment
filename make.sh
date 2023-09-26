#!/bin/bash

if [[ ! -f "./.env" ]]; then
  cp .env.example .env
  php artisan key:generate --ansi
  php artisan app:install
fi

./vendor/bin/sail up -d
printf "Preparing for database initialization"
for i in {1..5}
do
   printf "."
   sleep 1
done
printf "\n"
./vendor/bin/sail artisan migrate:fresh

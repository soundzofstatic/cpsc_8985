#!/usr/bin/env bash

set -e

# https://laravel-news.com/laravel-scheduler-queue-docker

role=${CONTAINER_ROLE:-app}
#env=${APP_ENV:-production}

# todo - Look at how to Cache
#if [ "$env" != "local" ]; then
#    echo "Caching configuration..."
#    (cd /var/www/html && php artisan config:cache && php artisan route:cache && php artisan view:cache)
#fi

if [ "$role" = "scheduler" ]; then

    while [ true ]
    do
      php /var/www/artisan schedule:run --verbose --no-interaction &
      sleep 60
    done

else

    echo "Could not match the container role \"$role\""
    exit 1

fi

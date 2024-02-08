#!/bin/sh

[ "$APP_DEBUG" == 'true' ] && set -x
set -e

composer_global_home="/home/$(id -u -n)/.composer"

if [ "$APP_DEBUG" == 'true' ]
then
    echo "> You will act as user: $(id -u -n)"
    echo "> Path to Composer home dir: ${composer_global_home}"
fi

php -d memory_limit=512M "${composer_global_home}/vendor/bin/phpcompatinfo" $@

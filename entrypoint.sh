#!/bin/sh

APP_BIN="phpcompatinfo"

[ "$APP_DEBUG" == 'true' ] && set -x
set -e

if [ ! -z ${GITHUB_WORKSPACE} ]; then
    APP_WORKSPACE=$GITHUB_WORKSPACE
elif [ ! -z ${CI_PROJECT_DIR} ]; then
    APP_WORKSPACE=$CI_PROJECT_DIR
else
    APP_WORKSPACE="/workdir"
fi

COMPOSER_HOME="/home/$(id -u -n)/.composer"

if [ "$APP_DEBUG" == 'true' ]
then
    echo "> You will act as user: $(id -u -n)"
    echo "> Your project source directory : $(ls -al $APP_WORKSPACE)"
fi

if [ ! -z ${INPUT_COMMAND} ]; then
    sh -c "cd $APP_WORKSPACE; php -d memory_limit=512M $COMPOSER_HOME/vendor/bin/$APP_BIN ${INPUT_COMMAND} ${INPUT_OPTIONS}"
else
    sh -c "cd $APP_WORKSPACE; php -d memory_limit=512M $COMPOSER_HOME/vendor/bin/$APP_BIN $*"
fi

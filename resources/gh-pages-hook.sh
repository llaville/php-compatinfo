#!/usr/bin/env bash

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

ASSETS_IMAGE_DIR="docs/assets/images"

php $SCRIPT_DIR/graph-uml/build.php application-analyser $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-collection $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-datacollector $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-event $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-extension $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-logger $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-parser $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-polyfills $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-profiler $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-query $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-service $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php application-sniffs $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php infrastructure-bus $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php infrastructure-framework $ASSETS_IMAGE_DIR
php $SCRIPT_DIR/graph-uml/build.php presentation-console $ASSETS_IMAGE_DIR

<!-- markdownlint-disable MD013 -->
# Getting started

## Requirements

* PHP 7.4 or greater
* ext-json
* ext-libxml
* ext-pcre
* ext-spl
* PHPUnit 9 or greater (if you want to run unit tests)

![GraPHP Composer](./graph-composer.svg)

Generated with [fork](https://github.com/markuspoerschke/graph-composer/tree/add-options-to-exclude) of [clue/graph-composer](https://github.com/clue/graph-composer).
Read more on [PR request](https://github.com/clue/graph-composer/pull/45).

## Installation

### With Composer

Install the PHP CompatInfo with [Composer](https://getcomposer.org/).
If you don't know yet what is composer, have a look [on introduction](http://getcomposer.org/doc/00-intro.md).

```shell
composer require bartlett/php-compatinfo ^6.1
```

### With Git

The PHP CompatInfo can be directly used from [GitHub](https://github.com/llaville/php-compatinfo.git)
by cloning the repository into a directory of your choice.

```shell
git clone -b 6.1 https://github.com/llaville/php-compatinfo.git
```

## Configuring the Database

The database connection information is stored as an environment variable called `DATABASE_URL`.

```shell
# to use mysql:
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"

# to use mariadb:
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.5.8"

# to use sqlite:
DATABASE_URL="sqlite:///${HOME}/.cache/bartlett/compatinfo-db.sqlite"

# to use postgresql:
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=11&charset=utf8"
```

If you change database connection, you have to run following commands:

- `vendor/bin/doctrine orm:schema-tool:create`
- `vendor/bartlett/php-compatinfo-db/bin/compatinfo-db db:init`

At dependencies installation, Composer use the sqlite back-end. You need to set up in your environment the `DATABASE_URL` variable.

If you use sqlite default back-end, you MUST run `composer run post-install-cmd` command.

## Build PHAR distribution

Uses the [BOX](https://github.com/box-project/box/) to compile your phar version of application.
Configuration file (`box.json.dist`) is provided with each release of phpCompatInfo.

**CAUTION** If you want to use the `--manifest` option of phpCompatInfo phar version, you MUST use
[my fork](https://github.com/llaville/box) (branch `build-metadata`) of Box project,
and apply the following patch.
All details are given in feature report since <https://github.com/box-project/box/issues/576#issuecomment-1002519231>

```text
diff --git a/src/Console/Command/Compile.php b/src/Console/Command/Compile.php
index 837466b..787058a 100644
--- a/src/Console/Command/Compile.php
+++ b/src/Console/Command/Compile.php
@@ -27,6 +27,8 @@ use function get_class;
 use Humbug\PhpScoper\Whitelist;
 use function implode;
 use function is_callable;
+use function is_file;
+use function is_readable;
 use function is_string;
 use KevinGH\Box\Box;
 use const KevinGH\Box\BOX_ALLOW_XDEBUG;
@@ -545,6 +547,10 @@ HELP;
                 'Setting metadata'
             );

+            if (is_file($metadata) && is_readable($metadata)) {
+                $metadata = require $metadata;
+            }
+
             if (is_callable($metadata)) {
                 $metadata = $metadata();
             }

```

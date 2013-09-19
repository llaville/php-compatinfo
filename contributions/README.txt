= Wanna help and contribute to the project ?

== You can propose new references

Here is a short procedure to generate new extension/reference for PHP_CompatInfo

On the command line run this command :
----
$ php genext.php
----

and follow instructions :
----
usage genext.php <extname> [<extversion>] [<defversion>]
----

For example: you want to propose a reference for pecl/uploadprogress 1.0.3
(http://pecl.php.net/package/uploadprogress)

Run this command:
----
$ php genext.php uploadprogress 1.0.3 5.2.0
----
Because PHP minimum version is 5.2.0 for the 1.0.3 release

By default result is printed to standard output (console). So use the redirection
to a file to keep results
----
$ php genext.php uploadprogress 1.0.3 5.2.0 > /tmp/uploadprogress.php
----

You can also generate a unit test class with the following command :
----
$ php gentest.php <extname>
----

On the same previous example, run this command:
----
$ php gentest.php uploadprogress
----

or this one if you want to write result to a file rather than standard output (console).
----
$ php gentest.php uploadprogress > /tmp/UploadprogressTest.php
----

and open a new ticket at Github with this file.


== You want to fix some documentation error or nasty bugs

Open a new issue at https://github.com/llaville/php-compat-info/issues

<?php
/**
 * Credits to https://github.com/PHPCompatibility/PHPCompatibility project for sniff examples file
 *
 * @link https://github.com/PHPCompatibility/PHPCompatibility/blob/fe409a40096336df71aefdc437d2bdd68aedc59f/Tests/sniff-examples/forbidden_names_as_declared.php
 */

/**
 * These keywords are ok to use as a function name.
 */
function null() {}
function true() {}
function false() {}
function bool() {}
function int() {}
function float() {}
function string() {}
function resource() {}
function object() {}
function mixed() {}
function numeric() {}
function iterable() {}

/**
 * These are all keywords that were added to the reserved list in 7.0 or later
 * and can not be used as class, interface, trait or namespace names.
 */
class null {}
class TRUE {} // Check case-insensitivity.
class false {}
class bool {}
class Int {} // Check case-insensitivity.
class float {}
class string {}
class resource {}
class obJeCt {}  // Check case-insensitivity.
class mixed {}
class numeric {}
class iterable {}
class never {}

interface null {}
interface true {}
interface false {}
interface bool {}
interface int {}
interface float {}
interface string {}
interface resource {}
interface object {}
interface mixed {}
interface numeric {}
interface iterable {}
interface never {}

// These have to be at the end of the file for PHP 5.2 not to fail on them...
trait null {}
trait true {}
trait false {}
trait bool {}
trait int {}
trait float {}
trait string {}
trait resource {}
trait object {}
trait mixed {}
trait numeric {}
trait iterable {}
trait never {}

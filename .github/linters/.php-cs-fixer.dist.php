<?php

$finder = (new PhpCsFixer\Finder())
    ->in('.')
;

return (new PhpCsFixer\Config())
    // allow to run on unsupported PHP Versions
    // {@link https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/README.md#supported-php-versions}
    // available since PHP-CS-Fixer 3.76.0
    // use instead `PHP_CS_FIXER_IGNORE_ENV` env var for older versions
    ->setUnsupportedPhpVersionAllowed(true)
    // use default @link https://www.php-fig.org/per/coding-style/
    ->setRules([
        '@PER-CS' => true,
        'blank_line_after_opening_tag' => false,
        'trailing_comma_in_multiline' => false,
        'no_extra_blank_lines' => false,
        'blank_lines_before_namespace' => false,
        'blank_line_between_import_groups' => false,
        'single_line_empty_body' => false,
        'array_syntax' => false,
        'ternary_operator_spaces' => false,
        'single_space_around_construct' => false,
        'operator_linebreak' => false,
    ])
    // default source code to scan
    ->setFinder($finder)
;

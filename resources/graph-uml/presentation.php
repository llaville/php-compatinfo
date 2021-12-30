<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.1.0
 * @author Laurent Laville
 */

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once __DIR__ . '/Graph.php';

$dataSource = dirname(__DIR__, 2) . '/src/Presentation';
$paths = ['Console'];

Graph::from($dataSource, $paths, basename(__FILE__, '.php'), $_SERVER['argv'][1] ?? null);

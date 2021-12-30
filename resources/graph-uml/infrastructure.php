<?php declare(strict_types=1);

/**
 * @since Release 6.1.0
 * @author Laurent Laville
 */

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once __DIR__ . '/Graph.php';

$dataSource = dirname(__DIR__, 2) . '/src/Infrastructure';
$paths = ['Bus', 'Framework'];

Graph::from($dataSource, $paths, basename(__FILE__, '.php'), $_SERVER['argv'][1] ?? null);

<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 */

use Bartlett\CompatInfo\Application\Kernel\ConsoleKernel;
use Bartlett\CompatInfo\Presentation\Console\ApplicationInterface;
use Bartlett\CompatInfo\Presentation\Console\Command\AbstractCommand;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

require_once dirname(__DIR__) . '/config/bootstrap.php';

$kernel = new ConsoleKernel($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'tests', false);

$container = $kernel->createFromInput(new ArrayInput([]));

$app = $container->get(ApplicationInterface::class);

$diagnoseCommand = $app->find('diagnose');

$diagnoseOutput = new BufferedOutput();
$diagnoseOutput->setDecorated(true);

$statusCode = $diagnoseCommand->run(new ArrayInput([]), $diagnoseOutput);

if ($statusCode === AbstractCommand::FAILURE) {
    echo $diagnoseOutput->fetch();
    exit($statusCode);
}

<?php
/**
 * Script to handle compatinfo.sqlite file, that provides all references.
 *
 * CAUTION: uses at your own risk.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php BSD License
 * @since    Release 4.0.0alpha3
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once __DIR__ . '/ReferenceCollection.php';

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Backup copy of the database
 */
class DbBackupCommand extends Command
{
    protected function configure()
    {
        $this->setName('db:backup')
            ->setDescription('Backup the current SQLite compatinfo database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source  = $this->getApplication()->getDbFilename();
        $tempDir = $this->getApplication()->getAppTempDir() . '/backups';

        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        $sha1 = sha1_file($source);
        $dest = $tempDir . '/' . basename($source) . ".$sha1";

        copy($source, $dest);

        $output->writeln(
            sprintf(
                'Database <info>%s</info> sha1: <comment>%s</comment>' .
                ' was copied to <comment>%s</comment>',
                $source,
                $sha1,
                $dest
            )
        );
    }
}

/**
 * Initiliaze the database with JSON files for one or all extensions.
 */
class DbInitCommand extends Command
{
    private $extensions;

    protected function configure()
    {
        $this->setName('db:init')
            ->setDescription('Load JSON file(s) in SQLite database')
            ->addArgument(
                'extension',
                InputArgument::OPTIONAL,
                'extension to load in database (case insensitive)'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $this->getApplication()->getRefDir();

        $iterator = new \DirectoryIterator($path);
        $suffix   = '.extensions.json';

        foreach ($iterator as $file) {
            if (fnmatch('*'.$suffix, $file->getPathName())) {
                $className = str_replace($suffix, '', basename($file));
                $extName   = strtolower($className);

                $this->extensions[] = $extName;
            }
        }

        $extension = trim($input->getArgument('extension'));
        $extension = strtolower($extension);

        if (empty($extension)) {
            $extensions = $this->extensions;
        } else {
            if (!in_array($extension, $this->extensions)) {
                $output->writeln(
                    sprintf('<error>Extension %s does not exist.</error>', $extension)
                );
                return;
            }
            $extensions = array($extension);
        }

        // do a DB backup first
        $command = $this->getApplication()->find('db:backup');
        $arguments = array(
            'command' => 'db:backup',
        );
        $input = new ArrayInput($arguments);
        $returnCode = $command->run($input, $output);

        if ($returnCode !== 0) {
            $output->writeln('<error>DB backup not performed</error>');
            return;
        }

        // then delete current DB before to init a new copy again
        unlink($this->getApplication()->getDbFilename());

        $pdo = new \PDO('sqlite:' . $this->getApplication()->getDbFilename());
        $ref = new ReferenceCollection($pdo);

        $max = count($extensions);

        $progress = new ProgressBar($output, $max);
        $progress->setFormat(' %percent:3s%% %elapsed:6s% %memory:6s% %message%');
        $progress->setMessage('');

        $progress->start();

        foreach ($extensions as $refName) {
            $pdo->beginTransaction();

            $ext  = 'extensions';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            $ref->addExtension($data);

            $ext  = 'releases';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addRelease($rec);
            }

            $ext  = 'interfaces';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addInterface($rec);
            }

            $ext  = 'classes';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addClass($rec);
            }

            $ext  = 'functions';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addFunction($rec);
            }

            $ext  = 'constants';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addConstant($rec);
            }

            $ext  = 'iniEntries';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addIniEntry($rec);
            }

            $ext  = 'const';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addClassConstant($rec);
            }

            $ext  = 'methods';
            $progress->setMessage(
                sprintf("Building %s (%s)", $ext, $refName)
            );
            $progress->display();
            $data = $this->readJsonFile($refName, $ext);
            foreach ($data as $rec) {
                $ref->addMethod($rec);
            }

            $pdo->commit();
            $progress->advance();
        }
        $progress->finish();
        $output->writeln('');
    }

    private function readJsonFile($refName, $ext)
    {
        $filename = $this->getApplication()->getRefDir() . '/' . ucfirst($refName) . ".$ext.json";
        if (!file_exists($filename)) {
            return array();
        }
        $jsonStr = file_get_contents($filename);
        $data    = json_decode($jsonStr, true);
        return $data;
    }
}

/**
 * Update the database with one or more JSON files.
 */
class DbUpdateCommand extends Command
{
    protected function configure()
    {
        $this->setName('db:update')
            ->setDescription('Update an extension with a JSON file')
            ->addArgument(
                'extension',
                InputArgument::REQUIRED,
                'extension to update in database (case insensitive)'
            )
            ->addArgument(
                'group',
                InputArgument::REQUIRED,
                'group of information to update in database (releases, classes, ...)'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $extension = trim($input->getArgument('extension'));
        $group     = trim($input->getArgument('group'));

        $refName = ucfirst(strtolower($extension));
        $ext     = $group;
        $data    = $this->readJsonFile($refName, $ext);

        if (!$data) {
            if (json_last_error() == JSON_ERROR_NONE) {
                $error = sprintf('File %s.%s.json does not exist.', $refName, $ext);
            } else {
                $error = sprintf('Cannot decode file %s.%s.json', $refName, $ext);
            }

            $output->writeln(
                sprintf('<error>%s</error>', $error)
            );
            return;
        }

        $pdo = new \PDO('sqlite:' . $this->getApplication()->getDbFilename());
        $ref = new ReferenceCollection($pdo);

        $max = count($data);

        $progress = new ProgressBar($output, $max);
        $progress->setFormat(' %percent:3s%% %elapsed:6s% %memory:6s% %message%');

        $progress->setMessage(
            sprintf("Building %s (%s)", $ext, $refName)
        );
        $progress->start();

        $updates = 0;
        $adds    = 0;

        foreach ($data as $rec) {
            switch ($ext) {
                case 'releases':
                    $res = $ref->addRelease($rec);
                    break;
                case 'iniEntries':
                    $res = $ref->addIniEntry($rec);
                    break;
                case 'classes':
                    $res = $ref->addClass($rec);
                    break;
                case 'interfaces':
                    $res = $ref->addInterface($rec);
                    break;
                case 'methods':
                    $res = $ref->addMethod($rec);
                    break;
                case 'const':
                    $res = $ref->addClassConstant($rec);
                    break;
                case 'functions':
                    $res = $ref->addFunction($rec);
                    break;
                case 'constants':
                    $res = $ref->addConstant($rec);
                    break;
                default:
                    // do nothing
                    $res = 0;
            }

            if ($res < 0) {
                // update applied
                ++$updates;

            } elseif ($res > 0) {
                // add applied
                ++$adds;
            }

            $progress->advance();
        }
        $progress->finish();
        $progress->clear();

        if (($adds + $updates) === 0) {
            $message = sprintf('No changes on <info>%s</info>', $extension);
        } else {
            $message = sprintf(
                'Extension <info>%s</info> was updated with %d adds, %d updates.',
                $extension,
                $adds,
                $updates
            );
        }

        $output->writeln(PHP_EOL . $message);
    }

    private function readJsonFile($refName, $ext)
    {
        $filename = $this->getApplication()->getRefDir() . '/' . ucfirst($refName) . ".$ext.json";
        if (!file_exists($filename)) {
            return false;
        }
        $jsonStr = file_get_contents($filename);
        $data    = json_decode($jsonStr, true);
        return $data;
    }
}

/**
 * Symfony Console Application to handle the SQLite compatinfo database.
 */
class DbHandleApplication extends Application
{
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new DbBackupCommand();
        $defaultCommands[] = new DbInitCommand();
        $defaultCommands[] = new DbUpdateCommand();

        return $defaultCommands;
    }

    public function getDbFilename()
    {
        $database = 'compatinfo.sqlite';
        $source   = __DIR__ . '/' . $database;

        return $source;
    }

    public function getAppTempDir()
    {
        return sys_get_temp_dir() . '/bartlett';
    }

    public function getRefDir()
    {
        return __DIR__ . '/references';
    }
}

$application = new DbHandleApplication();
$application->run();

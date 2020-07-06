<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * {Description}
 * self, parent and static are now always case insensitive
 * Prior to PHP 5.5, cases existed where the self, parent, and static
 * keywords were treated in a case sensitive fashion. These have now
 * been resolved, and these keywords are always handled case
 * insensitively: SELF::CONSTANT is now treated identically to
 * self::CONSTANT.
 *
 * {Reference}
 * http://php.net/manual/en/migration55.incompatible.php#migration55.incompatible.self-parent-static
 */
class NoCompatKeywordCaseInsensitiveSniff extends SniffAbstract
{
    private $noCompat;

    public function setUpBeforeSniff(): void
    {
        parent::setUpBeforeSniff();

        $this->noCompat = array();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->noCompat)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::NO_COMPAT_KEYWORD => $this->noCompat)
            );
        }
    }

    public function enterNode(Node $node): void
    {
        if (!$this->hasStaticReservedKeyword($node)) {
            return;
        }

        $name = (string) $node->class;

        if (!in_array(strtolower($name), array('self', 'parent', 'static'))) {
            return;
        }
        if (strcmp($name, strtolower($name)) === 0) {
            return;
        }

        $version  = '5.5.0';
        $severity = $this->getCurrentSeverity($version, 'lt', 'notice');
        $message  = sprintf(
            '<info>%s</info> will be case insensitive, treated identically to %s',
            $name,
            strtolower($name)
        );

        if (!isset($this->noCompat[$name])) {
            $this->noCompat[$name] = array(
                'severity' => $severity,
                'version'  => $version,
                'message'  => $message,
                'spots'    => array()
            );
        }
        $this->noCompat[$name]['spots'][] = $this->getCurrentSpot($node);
    }

    protected function hasStaticReservedKeyword(Node $node): bool
    {
        return (
            ($node instanceof Node\Expr\StaticCall || $node instanceof Node\Expr\StaticPropertyFetch)
            && $node->class instanceof Node\Name
        );
    }
}

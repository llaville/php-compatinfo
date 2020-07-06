<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Use of nowdoc strings
 * Use of heredoc strings
 *
 * @link http://php.net/manual/en/language.types.string.php#language.types.string.syntax.nowdoc
 * @link https://github.com/wimg/PHPCompatibility/issues/48
 *
 * @link http://php.net/manual/en/migration53.new-features.php
 * @link https://github.com/wimg/PHPCompatibility/issues/51
 */
class DocStringSyntaxSniff extends SniffAbstract
{
    private $docStringSyntax;
    private $tokens;
    private $currentProperty;

    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->docStringSyntax = array();

        $this->tokens = $this->visitor->getTokens();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->docStringSyntax)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::DOC_STRING_SYNTAX => $this->docStringSyntax)
            );
        }
    }

    /**
     * @param Node $node
     * @return void
     */
    public function enterNode(Node $node): void
    {
        parent::enterNode($node);

        if ($node instanceof Node\Stmt\PropertyProperty) {
            $this->currentProperty = $node;
        }

        if ($node instanceof Node\Scalar\String_) {
            if ($this->isHeredocSyntax($node)) {
                if (null === $this->currentProperty) {
                    $name = 'heredoc';
                } else {
                    $name = 'heredoc-class-props';
                }

                if (!isset($this->docStringSyntax[$name])) {
                    $version = '5.3.0';

                    $this->docStringSyntax[$name] = array(
                        'severity' => $this->getCurrentSeverity($version),
                        'version'  => $version,
                        'spots'    => array()
                    );
                }
                $this->docStringSyntax[$name]['spots'][] = $this->getCurrentSpot($node);

            } elseif ($this->isNowdocSyntax($node)) {
                $name = 'nowdoc';

                if (!isset($this->docStringSyntax[$name])) {
                    $version = '5.3.0';

                    $this->docStringSyntax[$name] = array(
                        'severity' => $this->getCurrentSeverity($version),
                        'version'  => $version,
                        'spots'    => array()
                    );
                }
                $this->docStringSyntax[$name]['spots'][] = $this->getCurrentSpot($node);
            }
        }
    }

    /**
     * @param Node $node
     * @return void
     */
    public function leaveNode(Node $node): void
    {
        parent::leaveNode($node);

        if ($node instanceof Node\Stmt\PropertyProperty) {
            $this->currentProperty = null;
        }
    }

    protected function isHeredocSyntax(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');
        return (strpos($this->tokens[$i][1], "<<<") === 0
            && $this->tokens[$i][1][3] !== "'"
        );
    }

    protected function isNowdocSyntax(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');
        return (strpos($this->tokens[$i][1], "<<<'") === 0);
    }
}

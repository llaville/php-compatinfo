#!/usr/bin/env php
<?php
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.3.0
 * @author Laurent Laville
 */


/**
 * Extracts the latest release note.
 *
 * All text found between `<!-- MARKDOWN-RELEASE:START -->` and `<!-- MARKDOWN-RELEASE:END -->` tags
 */
$inputFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'CHANGELOG-6.x.md';
$releaseNotes = [];

$markdown = file_get_contents($inputFile);
$matched = preg_match('/.*(<!-- MARKDOWN-RELEASE:START -->\n)(.*)?(<!-- MARKDOWN-RELEASE:END -->\n).*/smi', $markdown, $releaseNotes);
if (!$matched) {
    // no release notes found
    exit(1);
}

$bytes = file_put_contents(dirname($inputFile) . DIRECTORY_SEPARATOR . 'releaseNotes.md', $releaseNotes[2]);
if (!$bytes) {
    // unable to write the current release notes
    exit(2);
}

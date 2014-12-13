<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MailparseExtension extends AbstractReference
{
    const REF_NAME    = 'mailparse';
    const REF_VERSION = '2.1.6';  // 2012-03-09 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.9
        if (version_compare($version, '0.9', 'ge')) {
            $release = $this->getR00900();
            $this->storage->attach($release);
        }
    }

    protected function getR00900()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.9',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2002-12-12',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mailparse.def_charset'                     => null,
        );
        $release->classes = array(
            'mimemessage'                               => null,
        );
        $release->constants = array(
            'MAILPARSE_EXTRACT_OUTPUT'                  => null,
            'MAILPARSE_EXTRACT_RETURN'                  => null,
            'MAILPARSE_EXTRACT_STREAM'                  => null,
        );
        $release->functions = array(
            'mailparse_determine_best_xfer_encoding'    => null,
            'mailparse_msg_create'                      => null,
            'mailparse_msg_extract_part'                => null,
            'mailparse_msg_extract_part_file'           => null,
            'mailparse_msg_extract_whole_part_file'     => null,
            'mailparse_msg_free'                        => null,
            'mailparse_msg_get_part'                    => null,
            'mailparse_msg_get_part_data'               => null,
            'mailparse_msg_get_structure'               => null,
            'mailparse_msg_parse'                       => null,
            'mailparse_msg_parse_file'                  => null,
            'mailparse_rfc822_parse_addresses'          => null,
            'mailparse_stream_encode'                   => null,
            'mailparse_test'                            => null,
            'mailparse_uudecode_all'                    => null,
        );
        return $release;
    }
}

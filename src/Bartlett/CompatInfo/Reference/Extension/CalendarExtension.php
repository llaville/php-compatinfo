<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class CalendarExtension extends AbstractReference
{
    const REF_NAME    = 'calendar';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.7
        if (version_compare($version, '4.0.7', 'ge')) {
            $release = $this->getR40007();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'CAL_DOW_DAYNO'                 => null,
            'CAL_DOW_LONG'                  => null,
            'CAL_DOW_SHORT'                 => null,
            'CAL_FRENCH'                    => null,
            'CAL_GREGORIAN'                 => null,
            'CAL_JEWISH'                    => null,
            'CAL_JULIAN'                    => null,
            'CAL_MONTH_FRENCH'              => null,
            'CAL_MONTH_GREGORIAN_LONG'      => null,
            'CAL_MONTH_GREGORIAN_SHORT'     => null,
            'CAL_MONTH_JEWISH'              => null,
            'CAL_MONTH_JULIAN_LONG'         => null,
            'CAL_MONTH_JULIAN_SHORT'        => null,
            'CAL_NUM_CALS'                  => null,
        );
        $release->functions = array(
            'easter_date'                   => null,
            'easter_days'                   => null,
            'frenchtojd'                    => null,
            'gregoriantojd'                 => null,
            'jddayofweek'                   => null,
            'jdmonthname'                   => null,
            'jdtofrench'                    => null,
            'jdtogregorian'                 => null,
            'jdtojewish'                    => array('4.0.0', '', '4.0.0, 4.3.0, 5.0.0'),
            'jdtojulian'                    => null,
            'jdtounix'                      => null,
            'jewishtojd'                    => null,
            'juliantojd'                    => null,
            'unixtojd'                      => null,
        );
        return $release;
    }

    protected function getR40007()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.7',
            'ext.max' => '',
            'state'   => '',
            'date'    => '',
            'php.min' => '4.0.7',
            'php.max' => '',
        );
        $release->functions = array(
            'cal_days_in_month'             => null,
            'cal_from_jd'                   => null,
            'cal_info'                      => null,
            'cal_to_jd'                     => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'CAL_EASTER_ALWAYS_GREGORIAN'   => null,
            'CAL_EASTER_ALWAYS_JULIAN'      => null,
            'CAL_EASTER_DEFAULT'            => null,
            'CAL_EASTER_ROMAN'              => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'CAL_JEWISH_ADD_ALAFIM'         => null,
            'CAL_JEWISH_ADD_ALAFIM_GERESH'  => null,
            'CAL_JEWISH_ADD_GERESHAYIM'     => null,
        );
        return $release;
    }
}

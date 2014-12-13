<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class GmpExtension extends AbstractReference
{
    const REF_NAME    = 'gmp';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $this->storage->attach($release);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $this->storage->attach($release);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $this->storage->attach($release);
        }

        // 5.6.0alpha1
        if (version_compare($version, '5.6.0alpha1', 'ge')) {
            $release = $this->getR50600a1();
            $this->storage->attach($release);
        }

        // 5.6.1RC1
        if (version_compare($version, '5.6.1RC1', 'ge')) {
            $release = $this->getR50601rc1();
            $this->storage->attach($release);
        }

        // 5.6.3RC1
        if (version_compare($version, '5.6.3RC1', 'ge')) {
            $release = $this->getR50603rc1();
            $this->storage->attach($release);
        }
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'gmp_abs'               => null,
            'gmp_add'               => null,
            'gmp_and'               => null,
            'gmp_clrbit'            => null,
            'gmp_cmp'               => null,
            'gmp_com'               => null,
            'gmp_div'               => null,
            'gmp_div_q'             => null,
            'gmp_div_qr'            => null,
            'gmp_div_r'             => null,
            'gmp_divexact'          => null,
            'gmp_fact'              => null,
            'gmp_gcd'               => null,
            'gmp_gcdext'            => null,
            'gmp_hamdist'           => null,
            'gmp_init'              => null,
            'gmp_intval'            => null,
            'gmp_invert'            => null,
            'gmp_jacobi'            => null,
            'gmp_legendre'          => null,
            'gmp_mod'               => null,
            'gmp_mul'               => null,
            'gmp_neg'               => null,
            'gmp_or'                => null,
            'gmp_perfect_square'    => null,
            'gmp_popcount'          => null,
            'gmp_pow'               => null,
            'gmp_powm'              => null,
            'gmp_prob_prime'        => null,
            'gmp_random'            => null,
            'gmp_scan0'             => null,
            'gmp_scan1'             => null,
            'gmp_setbit'            => null,
            'gmp_sign'              => null,
            'gmp_sqrt'              => null,
            'gmp_sqrtrem'           => null,
            'gmp_strval'            => null,
            'gmp_sub'               => null,
            'gmp_xor'               => null,
        );
        $release->constants = array(
            'GMP_ROUND_MINUSINF'    => null,
            'GMP_ROUND_PLUSINF'     => null,
            'GMP_ROUND_ZERO'        => null,
            'GMP_VERSION'           => null,
        );
        return $release;
    }

    protected function getR50200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'gmp_nextprime'         => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'gmp_testbit'           => null,
        );

        /*
            Windows only:
            The GMP extension now relies on MPIR instead of the GMP library
         */
        if (PATH_SEPARATOR == ';') {
            $release->constants = array(
                'GMP_MPIR_VERSION'  => null,
            );
        }
        return $release;
    }

    protected function getR50600a1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-01-21',
            'php.min' => '5.6.0alpha1',
            'php.max' => '',
        );
        $release->functions = array(
            'gmp_root'              => null,
            'gmp_rootrem'           => null,
        );
        return $release;
    }

    protected function getR50601rc1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.1RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-09-11',
            'php.min' => '5.6.1RC1',
            'php.max' => '',
        );
        $release->functions = array(
            'gmp_import'            => null,
            'gmp_export'            => null,
        );
        $release->constants = array(
            'GMP_BIG_ENDIAN'        => null,
            'GMP_LITTLE_ENDIAN'     => null,
            'GMP_LSW_FIRST'         => null,
            'GMP_MSW_FIRST'         => null,
            'GMP_NATIVE_ENDIAN'     => null,
        );
        return $release;
    }

    protected function getR50603rc1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.3RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-10-28',
            'php.min' => '5.6.3RC1',
            'php.max' => '',
        );
        $release->functions = array(
            'gmp_random_bits'       => null,
            'gmp_random_range'      => null,
        );
        return $release;
    }
}

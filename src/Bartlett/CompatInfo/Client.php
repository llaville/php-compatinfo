<?php declare(strict_types=1);

/**
 * Client for interacting with the API
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo;

use Bartlett\Reflect\Api\BaseApi;
use Bartlett\Reflect\Client\LocalClient;

/**
 * Client for interacting with the API
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.4.0
 */
class Client
{
    const API_V5 = 'http://php5.laurent-laville.org/compatinfo/api/v5/';

    private $client;
    private $token;

    /**
     * Initialize a client for interacting with the API
     */
    public function __construct()
    {
        $this->client = new LocalClient('Bartlett\CompatInfo\Api\V5');
    }

    /**
     * Returns an Api
     *
     * @param string $name Api method to perform
     *
     * @return BaseApi
     * @throws \InvalidArgumentException
     */
    public function api($name): BaseApi
    {
        $classes = array(
            'Bartlett\CompatInfo\Api\\' => array(
                'Analyser',
                'Reference'
            ),
        );

        $class = false;

        foreach ($classes as $ns => $basename) {
            if (in_array(ucfirst($name), $basename)) {
                $class = $ns . ucfirst($name);
                break;
            }
        }

        if (!$class || !class_exists($class)) {
            throw new \InvalidArgumentException(
                sprintf('Unknown Api "%s" requested', $name)
            );
        }

        $this->client->setNamespace($ns . 'V5');

        return new $class($this->client, $this->token);
    }

    /**
     * Authorizes an Api
     *
     * @param $token
     *
     * @return void
     */
    public function authorize($token): void
    {
        $this->token = $token;
    }
}

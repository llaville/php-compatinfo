<?php

namespace Bartlett;

use Bartlett\Reflect\Event\AbstractDispatcher;
use Bartlett\Reflect\ProviderManager;

class CompatInfo extends AbstractDispatcher
{
    protected $pm;
    protected $plugins;
    protected $metrics;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->plugins  = array();
        $this->metrics  = false;

        // Uses the same event dispatcher for both CompatInfo and Reflect
        $this->getEventDispatcher();
    }

    /**
     * Returns an instance of the current provider manager.
     *
     * @return ProviderManager
     */
    public function getProviderManager()
    {
        if (!isset($this->pm)) {
            $this->pm = new ProviderManager;
        }
        return $this->pm;
    }

    /**
     * Defines the current provider manager.
     *
     * @param ProviderManager $manager Instance of your custom source provider
     *
     * @return self for fluent interface
     */
    public function setProviderManager(ProviderManager $manager)
    {
        $this->pm = $manager;
        return $this;
    }

    /**
     * Adds one or more plugin to extends default behavior.
     *
     * @return self for fluent interface
     * @throws \InvalidArgumentException if invalid plugin provided
     */
    public function addPlugin($plugin)
    {
        $this->plugins[] = $plugin;
        return $this;
    }

    /**
     * Analyse all or part of data sources identified by the Provider Manager.
     *
     * @param array $providers (optional) Data source providers to parse at this runtime.
     *                         All providers defined in Provider Manager by default.
     *
     * @return self for fluent interface
     */
    public function parse(array $providers = null)
    {
        $reflect = new Reflect;
        // Use the same event dispatcher for both Reflect and CompatInfo
        $reflect->setEventDispatcher(
            $this->getEventDispatcher()
        );
        $reflect->setProviderManager(
            $this->getProviderManager()
        );

        // Attach each plugin
        foreach ($this->plugins as $plugin) {
            $reflect->addSubscriber($plugin);
        }

        // Parse data source(s)
        $reflect->parse($providers);

        // Collects final results
        foreach ($this->plugins as $plugin) {
            if (method_exists($plugin, 'getMetrics')) {
                $this->metrics = $plugin->getMetrics();
            }
        }
        return $this;
    }

    /**
     * Returns all informations collected via any analyser
     * and the Reflect AnalyserPlugin.
     *
     * @return array
     */
    public function getMetrics()
    {
        return $this->metrics;
    }
}

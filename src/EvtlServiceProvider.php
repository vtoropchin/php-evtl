<?php

namespace Vtoropchin\Evtl;

use Illuminate\Support\ServiceProvider;

class EvtlServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $connections = $this->app['config']['database.connections'];
        $connections['default'] = $connections[$this->app['config']['database.default']];

        foreach ($connections as $name => $config) {
            Evtl::service('db')->addConnection($config, $name);
        }
    }
}

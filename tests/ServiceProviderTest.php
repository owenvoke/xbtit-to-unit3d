<?php

namespace pxgamer\XbtitToUnit3d\Tests;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;
use pxgamer\XbtitToUnit3d\ServiceProvider;

class ServiceProviderTest extends TestCase
{
    /** @test Test able to load aggregate service providers. */
    public function itMakesTheServiceAvailable(): void
    {
        $loaded = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(ServiceProvider::class, $loaded);
        $this->assertTrue($loaded[ServiceProvider::class]);
    }

    /**
     * @param  Application  $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }
}

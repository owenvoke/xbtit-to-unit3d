<?php

namespace pxgamer\XbtitToUnit3d\Functionality;

use Orchestra\Testbench\TestCase;
use pxgamer\XbtitToUnit3d\ServiceProvider;

/**
 * Class ServiceProviderTest.
 */
class ServiceProviderTest extends TestCase
{
    /**
     * Test able to load aggregate service providers.
     */
    public function testServiceIsAvailable()
    {
        $loaded = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(ServiceProvider::class, $loaded);
        $this->assertTrue($loaded[ServiceProvider::class]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}

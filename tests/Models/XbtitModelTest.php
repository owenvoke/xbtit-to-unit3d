<?php

namespace pxgamer\XbtitToUnit3d\Models;

use Illuminate\Database\Capsule\Manager;
use PHPUnit\Framework\TestCase;

class XbtitModelTest extends TestCase
{
    protected $capsule;

    public function setUp()
    {
        $this->capsule = new Manager();

        $this->capsule->addConnection([
            'driver'    => 'sqlite',
            'host'      => ':memory:',
            'database'  => 'xbtit',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);
    }

    public function testCanConstructGazelleModel()
    {
        $xbtit = new GazelleModel($this->capsule);

        $this->assertInstanceOf(XbtitModel::class, $xbtit);
    }
}

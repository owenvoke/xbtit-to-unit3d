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

        $this->capsule->addConnection(
            [
                'driver'    => env('DB_CONNECTION', 'mysql'),
                'host'      => env('DB_HOST', '127.0.0.1'),
                'port'      => env('DB_PORT', 3306),
                'database'  => env('DB_DATABASE', 'unit3d'),
                'username'  => env('DB_USERNAME', 'root'),
                'password'  => env('DB_PASSWORD', 'root'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ]
        );

        $this->capsule->addConnection(
            [
                'driver'    => env('XBTIT_DB_CONNECTION', 'mysql'),
                'host'      => env('XBTIT_DB_HOST', '127.0.0.1'),
                'port'      => env('XBTIT_DB_PORT', 3306),
                'database'  => env('XBTIT_DB_DATABASE', 'xbtit'),
                'username'  => env('XBTIT_DB_USERNAME', 'root'),
                'password'  => env('XBTIT_DB_PASSWORD', 'root'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'xbtit'
        );
    }

    public function testCanConstructXbtitModel()
    {
        $xbtit = new XbtitModel($this->capsule);

        $this->assertInstanceOf(XbtitModel::class, $xbtit);
    }
}

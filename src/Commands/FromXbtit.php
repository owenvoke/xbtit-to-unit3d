<?php

namespace pxgamer\XbtitToUnit3d\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Capsule\Manager;
use pxgamer\XbtitToUnit3d\Models\Torrent;
use pxgamer\XbtitToUnit3d\Models\User;
use pxgamer\XbtitToUnit3d\Models\UserInfo;

class FromXbtit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unit3d:from-xbtit
                            {--driver=mysql : The XBTIT driver type to use (mysql, sqlsrv, etc.).}
                            {--host=localhost : The XBTIT hostname or IP.}
                            {--database= : The XBTIT database to select from.}
                            {--username= : The XBTIT mysql user.}
                            {--password= : The XBTIT mysql password.}
                            {--prefix= : The XBTIT hostname or IP.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from a XBTIT instance to UNIT3D.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \ErrorException
     */
    public function handle()
    {
        $capsule = $this->getCapsule();

        if (!$capsule->schema('xbtit')->hasTable('xbtit_users')) {
            throw new \ErrorException('XBTIT user tables missing.');
        }

        $users = new User($capsule);
        $users->importAll();

        if (!$capsule->schema('xbtit')->hasTable('xbtit_files')) {
            throw new \ErrorException('XBTIT torrent tables missing.');
        }

        $torrent = new Torrent($capsule);
        $torrent->importAll();
    }

    private function getCapsule()
    {
        $capsule = new Manager();

        $capsule->addConnection(
            [
                'driver'    => $this->option('driver'),
                'host'      => $this->option('host'),
                'database'  => $this->option('database'),
                'username'  => $this->option('username'),
                'password'  => $this->option('password'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => $this->option('prefix'),
            ],
            'xbtit'
        );

        $capsule->addConnection(
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

        $capsule->setAsGlobal();

        return $capsule;
    }
}

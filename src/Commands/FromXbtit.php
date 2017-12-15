<?php

namespace pxgamer\XbtitToUnit3d\Commands;

use App\Torrent;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FromXbtit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unit3d:from-xbtit
                            {--driver=mysql : The driver type to use (mysql, sqlsrv, etc.).}
                            {--host=localhost : The hostname or IP.}
                            {--database= : The database to select from.}
                            {--username= : The database user.}
                            {--password= : The database password.}
                            {--prefix= : The database hostname or IP.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from an XBTIT instance to UNIT3D.';

    protected $results = [];

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
        $this->checkRequired($this->options());

        config([
            'database.connections.imports' => [
                'driver'    => $this->option('driver'),
                'host'      => $this->option('host'),
                'database'  => $this->option('database'),
                'username'  => $this->option('username'),
                'password'  => $this->option('password'),
                'prefix'    => $this->option('prefix'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
        ]);

        $database = DB::connection('imports');

        $this->importTable($database, 'User', 'users', User::class);
        $this->importTable($database, 'Torrent', 'torrents', Torrent::class);
    }

    protected function importTable(Connection $database, string $type, string $oldTable, string $modelName)
    {
        if (!$database->getSchemaBuilder()->hasTable($oldTable)) {
            throw new \ErrorException('`'.$oldTable.'` table missing.');
        }

        $oldData = $database->query()->select()->from($oldTable)->get();

        foreach ($oldData->all() as $oldDataItem) {
            $data = $this->map($type, $oldDataItem);

            $this->results[$oldTable] = $this->import($modelName, $data);
        }
    }

    public function map(string $type, \stdClass $data): array
    {
        return $this->{'map'.$type}($data);
    }

    public function mapUser(\stdClass $data): array
    {
        return [
            'username'   => $data->username,
            'password'   => $data->password,
            'passkey'    => $data->salt,
            'group_id'   => $data->id_level,
            'email'      => $data->email,
            'uploaded'   => $data->uploaded,
            'downloaded' => $data->downloaded,
            'image'      => $data->avatar,
            'created_at' => Carbon::createFromTimestamp(strtotime($data->joined)),
            'last_login' => Carbon::createFromTimestamp(strtotime($data->lastconnect)),
        ];
    }

    public function mapTorrent(\stdClass $data): array
    {
        return [
            'info_hash'   => $data->info_hash,
            'name'        => $data->filename,
            'size'        => $data->size,
            'announce'    => $data->announce_url,
            'description' => $data->comment,
            'user_id'     => $data->uploader,
            'seeders'     => $data->seeds,
            'leechers'    => $data->leechers,
            'created_at'  => Carbon::createFromTimestamp(strtotime($data->data)),
            'updated_at'  => Carbon::createFromTimestamp(strtotime($data->lastupdate)),
        ];
    }

    private function import(string $model, array $data = []): bool
    {
        /** @var Model $new */
        $new = new $model();

        foreach ($data as $item => $value) {
            $new->$item = $value;
        }

        return $new->save();
    }

    private function checkRequired(array $options)
    {
        $requiredOptions = [
            'database',
            'username',
            'password',
        ];

        foreach ($requiredOptions as $option) {
            if (!key_exists($option, $options) || !$options[$option]) {
                throw new \InvalidArgumentException('Option `'.$option.'` not provided.');
            }
        }
    }
}

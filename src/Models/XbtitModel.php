<?php

namespace pxgamer\XbtitToUnit3d\Models;

use Illuminate\Database\Capsule\Manager;

class XbtitModel
{
    protected $capsule;
    protected $tables = [];
    protected $columns = [];

    public function __construct(Manager $capsule)
    {
        $this->capsule = $capsule;
    }

    public function importAll()
    {
        $gazelleConnection = $this->capsule->getConnection('xbtit');
        $all = $gazelleConnection
            ->table($this->tables['xbtit'])
            ->get(array_keys($this->columns));

        foreach ($all as $row) {
            $this->processRow($row);
        }
    }

    protected function processRow(\stdClass $row)
    {
        //
    }
}

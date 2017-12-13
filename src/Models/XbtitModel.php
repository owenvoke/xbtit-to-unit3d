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
        //
    }
}

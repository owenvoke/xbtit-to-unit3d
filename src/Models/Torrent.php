<?php

namespace pxgamer\XbtitToUnit3d\Models;

class Torrent extends XbtitModel
{
    protected $tables = [
        'xbtit'  => 'xbtit_files',
        'unit3d' => 'torrents',
    ];

    protected $columns = [
        'info_hash'    => 'info_hash',
        'filename'     => 'name',
        'size'         => 'size',
        'announce_url' => 'announce',
        'comment'      => 'description',
        'uploader'     => 'user_id',
        'seeds'        => 'seeders',
        'leechers'     => 'leechers',
    ];
}

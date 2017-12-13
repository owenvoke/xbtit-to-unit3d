<?php

namespace pxgamer\XbtitToUnit3d\Models;

class User extends XbtitModel
{
    protected $tables = [
        'xbtit'  => 'xbtit_users',
        'unit3d' => 'users',
    ];

    protected $columns = [
        'username'   => 'username',
        'password'   => 'password',
        'salt'       => 'passkey',
        'id_level'   => 'group_id',
        'email'      => 'email',
        'uploaded'   => 'uploaded',
        'downloaded' => 'downloaded',
        'avatar'     => 'image',
    ];
}

<?php

namespace pxgamer\XbtitToUnit3d\Functionality;

use Carbon\Carbon;

class Mapping
{
    /**
     * @param string $type
     * @param \stdClass $data
     * @return array
     */
    public static function map(string $type, \stdClass $data): array
    {
        return self::{'map'.$type}($data);
    }

    /**
     * @param \stdClass $data
     * @return array
     */
    public static function mapUser(\stdClass $data): array
    {
        return [
            'username'   => $data->username,
            'password'   => $data->password ?? null,
            'passkey'    => $data->pid ?? null,
            'group_id'   => $data->id_level ?? 1,
            'email'      => $data->email ?? null,
            'uploaded'   => $data->uploaded ?? 0,
            'downloaded' => $data->downloaded ?? 0,
            'image'      => $data->avatar ?? null,
            'created_at' => Carbon::createFromTimestamp(strtotime($data->joined)),
            'last_login' => Carbon::createFromTimestamp(strtotime($data->lastconnect)),
        ];
    }

    /**
     * @param \stdClass $data
     * @return array
     */
    public static function mapTorrent(\stdClass $data): array
    {
        return [
            'info_hash'   => $data->info_hash ?? null,
            'name'        => $data->filename ?? null,
            'size'        => $data->size ?? 0,
            'announce'    => $data->announce_url ?? null,
            'description' => $data->comment ?? null,
            'seeders'     => $data->seeds ?? 0,
            'leechers'    => $data->leechers ?? 0,
            'created_at'  => Carbon::createFromTimestamp(strtotime($data->data)),
            'updated_at'  => Carbon::createFromTimestamp(strtotime($data->lastupdate)),
        ];
    }
}

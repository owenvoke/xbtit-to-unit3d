<?php

namespace pxgamer\XbtitToUnit3d\Functionality;

use Carbon\Carbon;

/**
 * Class Mapping
 */
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

    /**
     * @param \stdClass $data
     * @return array
     */
    public static function mapTorrent(\stdClass $data): array
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
}

<?php

namespace pxgamer\XbtitToUnit3d\Functionality;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;

class Imports
{
    /**
     * @param Connection $database
     * @param string $type
     * @param string $oldTable
     * @param string $modelName
     *
     * @return array
     *
     * @throws \ErrorException
     */
    public static function importTable(Connection $database, string $type, string $oldTable, string $modelName)
    {
        $results = [];

        if (!$database->getSchemaBuilder()->hasTable($oldTable)) {
            throw new \ErrorException('`'.$oldTable.'` table missing.');
        }

        $oldData = $database->query()->select()->from($oldTable)->get();

        foreach ($oldData->all() as $oldDataItem) {
            $data = Mapping::map($type, $oldDataItem);

            $results[$oldTable] = self::import($modelName, $data);
        }

        return $results;
    }

    private static function import(string $model, array $data = []): bool
    {
        /** @var Model $new */
        $new = new $model();

        foreach ($data as $item => $value) {
            $new->$item = $value;
        }

        return $new->save();
    }
}

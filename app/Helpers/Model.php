<?php
namespace App\Helpers;
use Ramsey\Uuid\Uuid;

trait Model{
    public static function setData(array $data, $model)
    {
        $data['id'] = self::setUUid();
        $data['order'] = self::setOrder($model);
        $data['created_at'] = now();
        return $model::updateOrCreate($data);
    }

    public static function updateData(array $data, $model, array $where)
    {
        $data['updated_at'] = now();
        return $model::updateOrCreate($where,$data);
    }

    private static function setUUid()
    {
        return Uuid::uuid7(now());
    }

    private static function setOrder($model)
    {
        $sql = $model::latest('order')->first();
        return $sql ? $sql->order += 1 : 1;
    }
}
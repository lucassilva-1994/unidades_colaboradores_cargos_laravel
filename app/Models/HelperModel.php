<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class HelperModel extends Model
{
    public static function setData(array $data, $model)
    {
        $data['id'] = self::setUUid();
        $data['order'] = self::setOrder($model);
        $data['created_at'] = now();
        return $model::create($data);
    }

    public static function updateData(array $data, $model, array $where)
    {
        if(isset($data['updated_at'])){
            $data['updated_at'] = now();
        }
        return $model::where($where)->update($data);
    }

    private static function setUUid(){
        return Uuid::uuid4();
    }

    private static function setOrder($model){
        $sql = $model::latest('order')->first();
        return $sql ? $sql->order +=1 : 1;
    }
}

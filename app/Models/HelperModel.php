<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HelperModel extends Model
{
    public static function setData(array $data, $model){
        $data['created_at'] = now();
        if(isset($data['updated_at'])){
            $data['updated_at'] = now();
        }
        return $model::create($data);
    }

    public static function updatedata(array $data, $model, array $where){
        if(isset($data['updated_at'])){
            $data['updated_at'] = now();
        }
        return $model::where($where)->update($data);
    }
}

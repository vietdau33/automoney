<?php

namespace App\Http\Services;

use Exception;

class ModelService
{
    public static function insert(string $model, array $datas)
    {
        try {
            if (!str_contains($model, 'App\Models')) {
                $model = "App\Models\\$model";
            }

            $model = app($model);

            foreach ($datas as $key => $data) {
                $model->{$key} = $data;
            }

            if ($model->save()) {
                return $model;
            }

            return false;
        } catch (Exception $exception) {
            logger($exception->getMessage());
            return false;
        }
    }
}

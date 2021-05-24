<?php

namespace App\Traits;

trait HasPassword
{
    public static function bootHasPassword()
    {
        // encrypt the password
        static::creating(function ($model) {
            $model->password = bcrypt($model->password);
        });
    }
}

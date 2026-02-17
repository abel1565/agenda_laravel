<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Status_Citas extends Model
{
    protected $table = 'status_citas';

    protected  $fillable = [
        'name',
        'color',
    ];

    public function citas()
    {
        return $this->hasMany(Citas::class, 'status_id');
    }
}

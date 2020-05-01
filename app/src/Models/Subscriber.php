<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use SoftDeletes;

    protected $table = 'subscriber';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'email',
    ];

}

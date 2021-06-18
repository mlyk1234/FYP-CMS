<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $table = 'users';
    protected $guarded = [];
}

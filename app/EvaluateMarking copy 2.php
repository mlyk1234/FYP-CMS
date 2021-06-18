<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluateMarking extends Model
{
    public $table = 'evaluationbysupervisor';
    protected $cast = [
        'marksgiven' => 'integer',
    ];
}

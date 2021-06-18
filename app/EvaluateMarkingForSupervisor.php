<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluateMarkingForSupervisor extends Model
{
    public $table = 'evaluationbysupervisor';
    protected $cast = [
        'marksgiven' => 'integer',
    ];
}

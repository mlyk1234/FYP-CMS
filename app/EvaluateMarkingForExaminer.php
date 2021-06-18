<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluateMarkingForExaminer extends Model
{
    public $table = 'evaluationbyexaminer';
    protected $cast = [
        'marksgiven' => 'integer',
    ];
}

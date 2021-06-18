<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GanttTask extends Model
{
    public $table = 'gantttasks';
    protected $appends = ["open"];
 
    public function getOpenAttribute(){
        return true;
    }
}

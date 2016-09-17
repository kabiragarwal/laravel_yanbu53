<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveAllSearche extends Model
{
    protected $table = 'saveallsearches';
    protected $fillable = ['user_id','search'];
}

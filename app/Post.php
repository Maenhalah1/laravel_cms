<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    protected $dates = ['created_at', 'updated_at'];


    protected $guarded = [];

    public function user(){
        return $this->belongsTo("App\User");
    }
}

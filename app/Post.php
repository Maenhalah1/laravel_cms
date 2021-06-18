<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Post extends Model
{

    protected $imgsDirectory = "uploads" . DIRECTORY_SEPARATOR . "posts_images";
    protected $appends = ["imgsPath"];

    protected $dates = ['created_at', 'updated_at'];


    protected $guarded = [];

    public function user(){
        return $this->belongsTo("App\User");
    }
    public function images(){
        return $this->morphMany("App\Image","imageable");
    }

    public function getImgsPathAttribute(){
        return Config::get("constents.DS") . $this->imgsDirectory . Config::get("constents.DS") . $this->id . Config::get("constents.DS");
    }
}

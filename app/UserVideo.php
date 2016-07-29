<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVideo extends Model
{
    protected $table = 'user_videos';
    
    public function video()
    {
        return $this->hasOne('App\Video', 'id','video_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
}

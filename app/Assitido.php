<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assitido extends Model
{
    public function video()
    {
        return $this->hasOne('App\Video', 'id','video_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
}

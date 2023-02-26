<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function userAndID(){
        return $this->user->id.' - '.$this->user->name;
    }
}

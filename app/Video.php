<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function type()
    {
        return $this->hasOne(Type::class);
    }

    public function submitter()
    {
        return $this->hasOne(User::class, 'id', 'submit_user');
    }
}

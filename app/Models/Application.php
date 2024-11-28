<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    const PENDING = null;
    const CANCEL = 0;
    const OK = 1;
    public function Job()
    {
        return $this->belongsTo( Job::class, 'job_id','id');
    }
    public function User()
    {
        return $this->belongsTo( User::class, 'user_id','id');
    }
}

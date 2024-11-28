<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_Category extends Model
{
    use HasFactory;
    protected $table = "job_categories";
    public function parent()
    {
        return $this->belongsTo(Job_Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Job_Category::class, 'parent_id');
    }
}

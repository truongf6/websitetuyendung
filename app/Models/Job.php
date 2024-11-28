<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = "jobs";
    protected $fillable = [
        'title',
        'job_categories_id-select',
        'type',
        'position',
        'location',
        'salary',
        'description',
        'name',
        'phone_number',
        'location-company',
        'thumb',
        'thumb-company',
        'Hide'
    ];
    public function User()
    {
        return $this->belongsTo( User::class, 'user_id','id');
    }
    public function Category()
    {
        return $this->belongsTo( Job_Category::class, 'job_categories_id','id');
    }
    public function Company()
    {
        return $this->belongsTo( Company::class, 'company_id','id');
    }
}

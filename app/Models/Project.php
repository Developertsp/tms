<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
<<<<<<< HEAD
        'description',
        'plan',
        'department_id',
        'ref_url',
        'deadline',
        'company_id',
        'status',
        'is_enable',
        'created_by',
=======
        'is_enable',
>>>>>>> f822cf6 (updation in the)
        'updated_by',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
<<<<<<< HEAD
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProjectAttachment::class);
    }
=======
>>>>>>> f822cf6 (updation in the)
}

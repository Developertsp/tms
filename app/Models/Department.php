<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
<<<<<<< HEAD
        'email',
        'members',
        'description',
        'company_id',
        'is_enable',
        'created_by',
=======
        'is_enable',
>>>>>>> f822cf6 (updation in the)
        'updated_by',
    ];

    public function users()
    {
<<<<<<< HEAD
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
=======
        return $this->hasMany(User::class);
>>>>>>> f822cf6 (updation in the)
    }
}

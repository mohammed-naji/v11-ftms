<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = ['name', 'image', 'description', 'location'];
    protected $guarded = [];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

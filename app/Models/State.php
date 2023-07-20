<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    public $timestamps = false;

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

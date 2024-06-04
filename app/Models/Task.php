<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'images',
        'deadline',
        'importance',
        'user_id',
    ];

    protected $casts = [
        'images' => 'array', 
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

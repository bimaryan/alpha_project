<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = ['users_id', 'judul', 'deskripsi', 'modul'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

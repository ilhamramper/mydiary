<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['emoji', 'unicode_hex'];

    public function diary()
    {
        return $this->hasMany(Diary::class);
    }
}

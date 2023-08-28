<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diary extends Model
{
    use SoftDeletes, HasTimestamps;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function reaction()
    {
        return $this->belongsTo(Reaction::class, 'unicode_hex', 'unicode_hex');
    }
}

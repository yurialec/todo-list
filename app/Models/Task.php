<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'attachment',
        'completed',
        'dt_created',
        'dt_completed',
        'dt_updated',
        'dt_deleted',
        'user_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSubmission extends Model
{
    protected $fillable = [
    'name',
    'email',
    'phone',
    'event_name',
    'start_time',
    'end_time',
    'location',
    'description',
    'file_path',
    'status'
];

}

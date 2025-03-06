<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        "frequency",
        "start_date",
        "days",
        "times",
        "notes",
    ];
}

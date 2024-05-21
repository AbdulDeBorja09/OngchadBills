<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Compute extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = [
        'name',
        'month',
        'year',
        'bill',
        'due',
        'kwh',
        'last_reading',
        'latest_reading',
        'total',
    ];
    public $timestamps = false;
}

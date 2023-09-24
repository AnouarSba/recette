<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
       
        'flexy',
        
        'tc',
        'tsc',
        'money',
        'sbm',
        'sbs',
        'sbn',

        'rq',
        'c_date'
    ];
}
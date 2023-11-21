<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'emp_id',
        'bus_id',
        'ligne_id',
        'flexy',
        'rotation',
        'dettes',
        't20',
        't25',
        't30',
        's20',
        's25',
        's30',
        'r20',
        'r25',
        'r30',
        'type',
        'brigade',

        'recette',
        'b_date'
    ];
}
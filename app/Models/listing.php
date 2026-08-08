<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'location',
        'price',
        'contact',
        'status',
        'reports',
    ];
}
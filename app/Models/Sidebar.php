<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model {
    use HasFactory;
    protected $table = 'sidebar';
    protected $fillable = [
        'box1content', 'box2content', 'box3content',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

class HomeAbout extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_dis',
        'long_dis',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutHeroSection extends Model
{
    use HasFactory;
    protected  $guarded = ['id'];
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'button_link',
        'short_description',
        'order_level',
        'status',
    ];
}

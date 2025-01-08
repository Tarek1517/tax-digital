<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMail extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','phone','companey_name', 'massage'];
    protected $guarded = ['id'];
}

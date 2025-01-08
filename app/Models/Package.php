<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['title','price','image','description', 'order_level', 'status', 'slug'];
    protected  $guarded = ['id'];

    public function orders()
	{
		return $this->hasMany(Order::class, 'package_id');
	}
}

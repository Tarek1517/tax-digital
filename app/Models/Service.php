<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['service_category_id','title', 'name','slug', 'image', 'icon', 'short_description', 'description', 'order_level', 'status'];
    protected $guarded = 'id';

    public function serviceCat(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}


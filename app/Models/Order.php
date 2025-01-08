<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'companey_name',
        'cus_name',
        'cus_phone',
        'cus_email',
        'total_payment',
        'payment_method',
        'package_name',
        'user_id',
        'order_code',
        'order_status'
    ];

    public function packages(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}

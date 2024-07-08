<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const ORDER_STATUS_PENDING = 'pending';
    const ORDER_STATUS_COMPLETED = 'completed';
    public array $statusArray = [self::ORDER_STATUS_PENDING, self::ORDER_STATUS_COMPLETED];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

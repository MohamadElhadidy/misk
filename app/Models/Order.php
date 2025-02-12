<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'address_id',
        'total_price',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            // Generate a random unique order_id with "ORD-" prefix and 8 uppercase letters
            do {
                // Generate a random 8-letter uppercase string and prepend "ORD-"
                $orderId = 'ORD-' . strtoupper(Str::random(8));
            } while (Order::where('order_id', $orderId)->exists()); // Ensure the order_id is unique

            // Assign the generated order_id to the model
            $order->order_id = $orderId;
        });
    }


    const STATUSES = ['pending' , 'processing', 'shipped', 'delivered', 'canceled', 'refunded', 'returned'];

    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => '#595a5c',   // Light gray (bg-gray-300 equivalent)
            'processing' => '#bd7804', // Golden Yellow (bg-yellow-500 equivalent)
            'shipped' => '#3B82F6',    // Bright Blue (bg-blue-500 equivalent)
            'delivered' => '#07a36f',  // Bright Green (bg-green-500 equivalent)
            'canceled' => '#EF4444',   // Bright Red (bg-red-500 equivalent)
            'refunded' => '#8B5CF6',   // Lavender Purple (bg-purple-500 equivalent)
            'returned' => '#FB923C',   // Bright Orange (bg-orange-500 equivalent)
        ];

        return $colors[$this->status] ?? '#595a5c'; // Default color if status is not found
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getOriginalPriceAttribute()
    {
        return $this->details->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });
    }


}

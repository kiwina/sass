<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'amount',
        'valid_until',
        'action_type',
        'redemptions',
        'max_redemptions',
        'max_redemptions_per_user',
        'is_recurring',
        'is_active',
        'duration_in_months',
        'maximum_recurring_intervals',
    ];

    protected static function booted(): void
    {
        static::updated(function (Discount $discount) {
            // delete discount_payment_provider_data when discount is updated to recreate provider discounts when discount is updated
            $discount->discountPaymentProviderData()->delete();
        });

        static::deleted(function (Discount $discount) {
            // delete discount_payment_provider_data when discount is deleted to recreate provider discounts when discount is deleted
            $discount->discountPaymentProviderData()->delete();
        });
    }

    public function discountPaymentProviderData()
    {
        return $this->hasMany(DiscountPaymentProviderData::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function oneTimeProducts()
    {
        return $this->belongsToMany(OneTimeProduct::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function codes()
    {
        return $this->hasMany(DiscountCode::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo',
        'user_name',
        'first_name',
        'last_name',
        'mobile_number',
        'email',
        'gender',
        'birth_date',
        'address',
        'password',
        'user_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
            ? User::whereBetween('created_at', [$request->start_date, $request->end_date])->whereNull('deleted_at')
            : User::whereNull('deleted_at');
        
            return $userWithDateFilter;
    }






    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function billingDetails()
    {
        return $this->hasMany(BillingDetail::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
    
}
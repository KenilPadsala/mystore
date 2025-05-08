<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'address1',
        'address2',
        'area',
        'pincode',
        'landmark',
        'city',
        'state',
        'mobile_no',
    ];

    /**
     * Relationship: Each address belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

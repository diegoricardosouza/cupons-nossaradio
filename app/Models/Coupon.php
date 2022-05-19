<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'downloads',
        'validity'
    ];

    // public function getValidityAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y');
    // }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
}

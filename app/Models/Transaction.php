<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// cmd used
// php artisan make:model Transaction -m

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'transaction_date',
        'amount',
        'description',
    ];

    // this column represent the default date and able to perform carbon method
    protected $dates = [
        'transaction_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // mutators
    public function setAmountAttribute($value)
    {
        // happened before saving or update eloquent model -- we will convert it to sans
        // e.g if we save 100 in amount field, this will change to 10000 in the database. when we get back from db, we will divide by 100
        $this->attributes['amount'] = $value * 100;
    }

    // mutators
    public function setTransactionDateAttribute($value)
    {
        // happened before saving or update eloquent model -- we will convert it to sans
        // e.g if we save 100 in amount field, this will change to 10000 in the database. when we get back from db, we will divide by 100
        $this->attributes['transaction_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }
}

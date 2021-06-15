<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Coupons
 * @package App\Models
 * @version June 15, 2021, 12:14 pm UTC
 *
 * @property string $name
 * @property string $price
 * @property string $code
 * @property string $date
 */
class Coupons extends Model
{


    public $table = 'coupons';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'price',
        'code',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'string',
        'code' => 'string',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'price' => 'required|string',
        'code' => 'required|string',
        'date' => 'required'
    ];

    
}

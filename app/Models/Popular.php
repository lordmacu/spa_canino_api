<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Popular
 * @package App\Models
 * @version June 20, 2021, 7:07 pm UTC
 *
 * @property integer $product_id
 */
class Popular extends Model
{


    public $table = 'populars';
    
     public function product(){
       return  $this->belongsTo(\App\Models\Products::class)->with("category");
    }

    public function getPopulars(){
        return $this->with("product")->get();
    }


    public $fillable = [
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}

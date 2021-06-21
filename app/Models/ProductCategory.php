<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class ProductCategory
 * @package App\Models
 * @version June 20, 2021, 6:56 pm UTC
 *
 * @property string $name
 */
class ProductCategory extends Model
{


    public $table = 'product_categories';
    



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}

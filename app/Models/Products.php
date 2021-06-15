<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Products
 * @package App\Models
 * @version June 15, 2021, 12:10 pm UTC
 *
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $category_id
 * @property integer $quantity
 * @property integer $status
 */
class Products extends Model
{


    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'quantity',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'image' => 'string',
        'category_id' => 'integer',
        'quantity' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|string',
        'category_id' => 'required|integer',
        'quantity' => 'required|integer',
        'status' => 'required|integer'
    ];

    
}

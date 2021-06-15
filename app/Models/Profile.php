<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Profile
 * @package App\Models
 * @version June 15, 2021, 12:06 pm UTC
 *
 * @property string $title
 * @property string $extract
 * @property string $description
 * @property string $image
 */
class Profile extends Model
{


    public $table = 'about';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'title',
        'extract',
        'description',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'extract' => 'string',
        'description' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'extract' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|string'
    ];

    
}

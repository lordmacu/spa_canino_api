<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Pets
 * @package App\Models
 * @version June 15, 2021, 12:12 pm UTC
 *
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $user_id
 */
class Pets extends Model
{


    public $table = 'pets';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    use SoftDeletes;



    public $fillable = [
        'name',
        'description',
        'image',
        'raza',
        'type',
        'color',
        'birthday',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'raza' => 'integer',
        'image' => 'string',
        'user_id' => 'string',
        'type' => 'integer',
        'color' => 'string',
        'birthday' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|string',
        'user_id' => 'required|integer'
    ];
    
    public function raza(){
        return $this->belongsTo(Raza::class,"raza","id");
    }
     public function type(){
        return $this->belongsTo(Type::class,"type","id");
    }
    
       public function status(){
        return $this->belongsTo(Type::class,"status","id");
    }
    
    
    public function getPetsByUser($user){
        return $this
                ->where("user_id",$user)
                ->with("raza")
                ->with("type")
                ->with("status")
                 ->get();
    }

    
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAboutAPIRequest;
use App\Http\Requests\API\UpdateAboutAPIRequest;
use App\Models\About;
use App\Models\Cart;
use App\Repositories\AboutRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AboutResource;
use Response;

/**
 * Class AboutController
 * @package App\Http\Controllers\API
 */

class CartAPIController extends AppBaseController
{
    public function addCart(Request $request){
        $cart= new Cart();
        $cart->user_id=$request->get("user_id");
        $cart->product_id=$request->get("product_id");
        $cart->save();
    }
}

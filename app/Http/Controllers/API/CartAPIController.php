<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCartAPIRequest;
use App\Http\Requests\API\UpdateCartAPIRequest;
use App\Models\Cart;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CartResource;
use Response;
use Log;

/**
 * Class CartController
 * @package App\Http\Controllers\API
 */

class CartAPIController extends AppBaseController
{
    /** @var  CartRepository */
    private $cartRepository;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepository = $cartRepo;
    }
    
      public function addCart(Request $request){
        $cart= new Cart();
        $cart->user_id=$request->get("user_id");
        $cart->product_id=$request->get("product_id");
        $cart->save();
    }
     public function deleteItemCart(Request $request){
        $cart= new Cart();
        
   
         $getCartByUserAndProduct= $cart->getCartByUserAndProduct($request->get("user_id"), $request->get("product_id"));
         $getCartByUserAndProduct->delete();
    
         
    }
    
       
      public function getCart(Request $request){
        $cart= new Cart();
        $getCartByUser=  $cart->getCartByUser($request->get("user_id"));
        
        return array("data"=>$getCartByUser);
        
    }
    
    
    
    
    

    /**
     * Display a listing of the Cart.
     * GET|HEAD /carts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $carts = $this->cartRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CartResource::collection($carts), 'Carts retrieved successfully');
    }

    /**
     * Store a newly created Cart in storage.
     * POST /carts
     *
     * @param CreateCartAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCartAPIRequest $request)
    {
        $input = $request->all();

        $cart = $this->cartRepository->create($input);

        return $this->sendResponse(new CartResource($cart), 'Cart saved successfully');
    }

    /**
     * Display the specified Cart.
     * GET|HEAD /carts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Cart $cart */
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            return $this->sendError('Cart not found');
        }

        return $this->sendResponse(new CartResource($cart), 'Cart retrieved successfully');
    }

    /**
     * Update the specified Cart in storage.
     * PUT/PATCH /carts/{id}
     *
     * @param int $id
     * @param UpdateCartAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cart $cart */
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            return $this->sendError('Cart not found');
        }

        $cart = $this->cartRepository->update($input, $id);

        return $this->sendResponse(new CartResource($cart), 'Cart updated successfully');
    }

    /**
     * Remove the specified Cart from storage.
     * DELETE /carts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Cart $cart */
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            return $this->sendError('Cart not found');
        }

        $cart->delete();

        return $this->sendSuccess('Cart deleted successfully');
    }
}

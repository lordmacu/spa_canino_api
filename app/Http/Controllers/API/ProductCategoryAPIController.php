<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductCategoryAPIRequest;
use App\Http\Requests\API\UpdateProductCategoryAPIRequest;
use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProductCategoryResource;
use Response;

/**
 * Class ProductCategoryController
 * @package App\Http\Controllers\API
 */

class ProductCategoryAPIController extends AppBaseController
{
    /** @var  ProductCategoryRepository */
    private $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepo)
    {
        $this->productCategoryRepository = $productCategoryRepo;
    }

    /**
     * Display a listing of the ProductCategory.
     * GET|HEAD /productCategories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productCategories = $this->productCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProductCategoryResource::collection($productCategories), 'Product Categories retrieved successfully');
    }

    /**
     * Store a newly created ProductCategory in storage.
     * POST /productCategories
     *
     * @param CreateProductCategoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductCategoryAPIRequest $request)
    {
        $input = $request->all();

        $productCategory = $this->productCategoryRepository->create($input);

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'Product Category saved successfully');
    }

    /**
     * Display the specified ProductCategory.
     * GET|HEAD /productCategories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'Product Category retrieved successfully');
    }

    /**
     * Update the specified ProductCategory in storage.
     * PUT/PATCH /productCategories/{id}
     *
     * @param int $id
     * @param UpdateProductCategoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        $productCategory = $this->productCategoryRepository->update($input, $id);

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'ProductCategory updated successfully');
    }

    /**
     * Remove the specified ProductCategory from storage.
     * DELETE /productCategories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        $productCategory->delete();

        return $this->sendSuccess('Product Category deleted successfully');
    }
}

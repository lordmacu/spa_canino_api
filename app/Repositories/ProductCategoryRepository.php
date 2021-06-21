<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

/**
 * Class ProductCategoryRepository
 * @package App\Repositories
 * @version June 20, 2021, 6:56 pm UTC
*/

class ProductCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductCategory::class;
    }
}

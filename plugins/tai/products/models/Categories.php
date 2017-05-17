<?php namespace Tai\Products\Models;

use Model;

/**
 * Model
 */
class Categories extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'tai_products_categories';


    /*
     * Relation
     * */
    public $attachOne = [
        'featured_image' => 'System\Models\File',
        'delete' => true
    ];

    public $belongsToMany = [
        'products' => [
            'Tai\Products\Models\Products',
            'table' => 'tai_products_categories_products',
            'key' => 'category_id',
            'otherKey' => 'product_id'
        ]
    ];


}
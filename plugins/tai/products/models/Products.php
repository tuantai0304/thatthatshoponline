<?php namespace Tai\Products\Models;

use October\Rain\Database\Model;

/**
 * Model
 */
class Products extends Model
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
    public $table = 'tai_products_product';

    /*
     * Relation
     * */
    public $attachOne = [
      'product_image' => 'System\Models\File',
        'delete' => true
    ];

    public $attachMany = [
      'product_gallery' => 'System\Models\File',
        'delete' => true
    ];

    public $belongsToMany = [
        'categories' => [
            'Tai\Products\Models\Categories',
            'table' => 'tai_products_categories_products',
            'key' => 'product_id',
            'otherKey' => 'category_id',
        ]
    ];
}
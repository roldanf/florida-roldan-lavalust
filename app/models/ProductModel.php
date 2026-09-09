<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: ProductModel
 *
 * Handles database access for the "products" table.
 */
class ProductModel extends Model {
    protected $table = 'products';
    protected $primary_key = 'id';
    protected $fillable = ['product_name', 'description', 'price', 'quantity'];
    protected $guarded = ['id'];
    protected $timestamps = false;

    public function __construct()
    {
        parent::__construct();
    }
}

<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: ProductController
 *
 * CRUD operations for the "products" table.
 * All actions in this controller are protected by AuthMiddleware
 * (see app/config/routes.php).
 */
class ProductController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library(['form_validation', 'session']);
        $this->call->helper(['url']);
        $this->call->model('ProductModel');
    }

    /**
     * Read - display all products
     */
    public function index()
    {
        $data['products'] = $this->ProductModel->all();
        $this->call->view('products/index', $data);
    }

    /**
     * Create - show form (GET) and save a new product (POST)
     */
    public function create()
    {
        if ($this->request->is_post()) {
            if ($this->form_validation->validate([
                'product_name|Product Name' => 'required|min_length[2]|max_length[100]',
                'description|Description'   => 'max_length[1000]',
                'price|Price'                => 'required|numeric|greater_than_equal_to[0]',
                'quantity|Quantity'          => 'required|numeric|greater_than_equal_to[0]',
            ])) {
                // success
                $this->ProductModel->insert([
                    'product_name' => $this->request->post('product_name'),
                    'description'  => $this->request->post('description'),
                    'price'        => $this->request->post('price'),
                    'quantity'     => $this->request->post('quantity'),
                ]);
                $this->session->set_flashdata('success', 'Product added successfully.');
                redirect('products');
            } else {
                // validation error
                $this->session->set_flashdata('error', $this->form_validation->errors());
                redirect('products/create');
            }
        }

        $this->call->view('products/create');
    }

    /**
     * Update - show form pre-filled (GET) and save changes (POST)
     */
    public function edit($id)
    {
        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('products');
        }

        if ($this->request->is_post()) {
            if ($this->form_validation->validate([
                'product_name|Product Name' => 'required|min_length[2]|max_length[100]',
                'description|Description'   => 'max_length[1000]',
                'price|Price'                => 'required|numeric|greater_than_equal_to[0]',
                'quantity|Quantity'          => 'required|numeric|greater_than_equal_to[0]',
            ])) {
                // success
                $this->ProductModel->update($id, [
                    'product_name' => $this->request->post('product_name'),
                    'description'  => $this->request->post('description'),
                    'price'        => $this->request->post('price'),
                    'quantity'     => $this->request->post('quantity'),
                ]);
                $this->session->set_flashdata('success', 'Product updated successfully.');
                redirect('products');
            } else {
                // validation error
                $this->session->set_flashdata('error', $this->form_validation->errors());
                redirect('products/edit/' . $id);
            }
        }

        $data['product'] = $product;
        $this->call->view('products/edit', $data);
    }

    /**
     * Delete - remove a product
     */
    public function delete($id)
    {
        $this->ProductModel->delete($id);
        $this->session->set_flashdata('success', 'Product deleted successfully.');
        redirect('products');
    }
}

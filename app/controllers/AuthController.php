<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: AuthController
 *
 * Handles login and logout for the Product Management CRUD pages.
 * Uses CrudUserModel ("crud_users" table) — separate from UsersModel,
 * which belongs to a different activity.
 */
class AuthController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library(['form_validation', 'session']);
        $this->call->helper(['url']);
        $this->call->model('CrudUserModel');
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Already logged in? Send them straight to the product list.
        if (isset($_SESSION['auth_user_id'])) {
            redirect('products');
        }

        if ($this->request->is_post()) {
            if ($this->form_validation->validate([
                'username|Username' => 'required',
                'password|Password' => 'required',
            ])) {
                $username = $this->request->post('username');
                $password = $this->request->post('password');

                $user = $this->CrudUserModel->find_by('username', $username);

                if ($user && password_verify($password, $user['password'])) {
                    // Prevent session fixation on login.
                    $this->session->regenerate_on_login();

                    $_SESSION['auth_user_id']   = $user['id'];
                    $_SESSION['auth_username']  = $user['username'];
                    $_SESSION['auth_role']      = $user['role'];

                    $this->session->set_flashdata('success', 'Logged in successfully.');
                    redirect('products');
                } else {
                    $this->session->set_flashdata('error', 'Invalid username or password.');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('error', $this->form_validation->errors());
                redirect('login');
            }
        }

        $this->call->view('auth/login');
    }

    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Already logged in? Send them straight to the product list.
        if (isset($_SESSION['auth_user_id'])) {
            redirect('products');
        }

        if ($this->request->is_post()) {
            if ($this->form_validation->validate([
                'username|Username'                 => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
                'password|Password'                 => 'required|min_length[6]',
                'confirm_password|Confirm Password' => 'required|matches[password]',
            ])) {
                $username = $this->request->post('username');
                $password = $this->request->post('password');

                // Manual uniqueness check (is_unique rule needs two params,
                // which the pipe-based rule syntax can't pass).
                if ($this->CrudUserModel->find_by('username', $username)) {
                    $this->session->set_flashdata('error', '"Username" already exists. Please choose another.');
                    redirect('register');
                }

                $this->CrudUserModel->insert([
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role'     => 'user',
                ]);

                $this->session->set_flashdata('success', 'Account created successfully. You may now log in.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', $this->form_validation->errors());
                redirect('register');
            }
        }

        $this->call->view('auth/register');
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->session->sess_destroy();
        redirect('login');
    }
}
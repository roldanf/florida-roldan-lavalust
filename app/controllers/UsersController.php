<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
	public function index()
	{
		// Load the UsersModel
		$this->call->model('UsersModel');

		// Retrieve all records from the users table
		$users = $this->UsersModel->all();

		// Pass the data to the view
		$this->call->view('users/index', ['users' => $users]);
	}
}
?>

<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: CrudUserModel
 *
 * Handles database access for THIS activity's "crud_users" table
 * (login/registration for the Product CRUD app).
 * Separate from UsersModel/the "users" table, which belongs to a
 * different activity and must not be touched.
 */
class CrudUserModel extends Model {
    protected $table = 'crud_users';
    protected $primary_key = 'id';
    protected $fillable = ['username', 'password', 'role'];
    protected $guarded = ['id'];
    protected $timestamps = false;

    public function __construct()
    {
        parent::__construct();
    }
}
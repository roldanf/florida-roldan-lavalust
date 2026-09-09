<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
	public function handle($next)
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		if (isset($_SESSION['auth_user_id'])) {
			return $next();
		}

		redirect(site_url('login') . '?denied=1');
	}
}
?>

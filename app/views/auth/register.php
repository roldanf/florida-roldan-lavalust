<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<style>
		* { box-sizing: border-box; }
		body {
			margin: 0;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: 'Segoe UI', Arial, sans-serif;
			background: #0f0c29;
			background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e, #1b1136);
			background-size: 400% 400%;
			animation: gradientShift 14s ease infinite;
			overflow: hidden;
			position: relative;
			padding: 20px;
		}
		@keyframes gradientShift {
			0%   { background-position: 0% 50%; }
			50%  { background-position: 100% 50%; }
			100% { background-position: 0% 50%; }
		}

		.blob {
			position: absolute;
			border-radius: 50%;
			filter: blur(80px);
			opacity: 0.45;
			z-index: 0;
		}
		.blob1 {
			width: 300px; height: 300px;
			background: #22d3ee;
			top: -50px; right: -60px;
			animation: float1 10s ease-in-out infinite;
		}
		.blob2 {
			width: 280px; height: 280px;
			background: #7c3aed;
			bottom: -70px; left: -50px;
			animation: float2 12s ease-in-out infinite;
		}
		@keyframes float1 {
			0%, 100% { transform: translate(0,0); }
			50% { transform: translate(-30px, 30px); }
		}
		@keyframes float2 {
			0%, 100% { transform: translate(0,0); }
			50% { transform: translate(30px, -30px); }
		}

		.auth-card {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 400px;
			padding: 42px 34px;
			border-radius: 20px;
			background: rgba(255, 255, 255, 0.06);
			backdrop-filter: blur(18px);
			-webkit-backdrop-filter: blur(18px);
			border: 1px solid rgba(255, 255, 255, 0.12);
			box-shadow: 0 25px 60px rgba(0,0,0,0.45);
			animation: cardIn 0.6s cubic-bezier(.22,1,.36,1);
		}
		@keyframes cardIn {
			0% { opacity: 0; transform: translateY(24px) scale(0.97); }
			100% { opacity: 1; transform: translateY(0) scale(1); }
		}

		.auth-card h1 {
			margin: 0 0 6px;
			font-size: 27px;
			font-weight: 700;
			text-align: center;
			background: linear-gradient(90deg, #67e8f9, #a78bfa);
			-webkit-background-clip: text;
			background-clip: text;
			color: transparent;
		}
		.auth-card p.subtitle {
			margin: 0 0 26px;
			text-align: center;
			color: rgba(255,255,255,0.55);
			font-size: 13.5px;
		}

		.field { margin-bottom: 16px; }
		.field label {
			display: block;
			margin-bottom: 7px;
			font-size: 12.5px;
			font-weight: 600;
			letter-spacing: 0.3px;
			color: rgba(255,255,255,0.75);
			text-transform: uppercase;
		}
		.field input,
		.field select {
			width: 100%;
			padding: 12px 14px;
			border: 1px solid rgba(255,255,255,0.15);
			border-radius: 10px;
			font-size: 14px;
			background: rgba(255,255,255,0.06);
			color: #fff;
			transition: border-color .25s, box-shadow .25s, background .25s;
			font-family: inherit;
		}
		.field input::placeholder { color: rgba(255,255,255,0.3); }
		.field input:focus,
		.field select:focus {
			outline: none;
			border-color: #67e8f9;
			background: rgba(255,255,255,0.1);
			box-shadow: 0 0 0 4px rgba(103,232,249,0.18);
		}
		.field select option {
			background: #1b1136;
			color: #fff;
		}

		.btn-submit {
			width: 100%;
			padding: 13px;
			border: none;
			border-radius: 10px;
			background: linear-gradient(90deg, #22d3ee, #7c3aed);
			background-size: 200% auto;
			color: #fff;
			font-size: 15px;
			font-weight: 700;
			letter-spacing: 0.3px;
			cursor: pointer;
			margin-top: 6px;
			transition: background-position .5s ease, transform .15s ease, box-shadow .3s ease;
			box-shadow: 0 8px 20px rgba(34,211,238,0.35);
		}
		.btn-submit:hover {
			background-position: right center;
			box-shadow: 0 8px 26px rgba(124,58,237,0.4);
			transform: translateY(-1px);
		}
		.btn-submit:active { transform: translateY(0); }

		.alert {
			padding: 10px 14px;
			border-radius: 10px;
			font-size: 13px;
			margin-bottom: 18px;
			animation: cardIn 0.4s ease;
		}
		.alert-success { background: rgba(34,197,94,0.15); color: #6ee7a0; border: 1px solid rgba(34,197,94,0.3); }
		.alert-error   { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }

		.switch-link {
			margin-top: 24px;
			text-align: center;
			font-size: 13px;
			color: rgba(255,255,255,0.5);
		}
		.switch-link a {
			color: #67e8f9;
			text-decoration: none;
			font-weight: 700;
			transition: color .2s;
		}
		.switch-link a:hover { color: #a78bfa; }
	</style>
</head>
<body>
	<div class="blob blob1"></div>
	<div class="blob blob2"></div>

	<div class="auth-card">
		<h1>Create Account</h1>
		<p class="subtitle">Sign up to manage products</p>

		<?php
		$session = $this->call->library('session');
		if ($session->flashdata('success')) {
			echo '<div class="alert alert-success">' . $session->flashdata('success') . '</div>';
		}
		if ($session->flashdata('error')) {
			echo '<div class="alert alert-error">' . $session->flashdata('error') . '</div>';
		}
		?>

		<form action="" method="post">
			<div class="field">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" placeholder="Pick a username">
			</div>

			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="At least 6 characters">
			</div>

			<div class="field">
				<label for="confirm_password">Confirm Password</label>
				<input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat your password">
			</div>

			<div class="field">
				<label for="role">Role</label>
				<select name="role" id="role">
					<option value="user">User</option>
					<option value="admin">Admin</option>
				</select>
			</div>

			<button type="submit" class="btn-submit">Register</button>
		</form>

		<p class="switch-link">
			Already have an account? <a href="<?= site_url('login'); ?>">Log In</a>
		</p>
	</div>
</body>
</html>

<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Product</title>
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
			animation: gradientShift 16s ease infinite;
			position: relative;
			overflow: hidden;
			padding: 30px 20px;
			color: #fff;
		}
		@keyframes gradientShift {
			0%   { background-position: 0% 50%; }
			50%  { background-position: 100% 50%; }
			100% { background-position: 0% 50%; }
		}

		.blob {
			position: absolute;
			border-radius: 50%;
			filter: blur(90px);
			opacity: 0.4;
			z-index: 0;
		}
		.blob1 { width: 320px; height: 320px; background: #7c3aed; top: -70px; left: -70px; animation: float1 11s ease-in-out infinite; }
		.blob2 { width: 280px; height: 280px; background: #22d3ee; bottom: -70px; right: -50px; animation: float2 13s ease-in-out infinite; }
		@keyframes float1 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(35px,25px); } }
		@keyframes float2 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(-25px,-35px); } }

		.form-card {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 460px;
			padding: 40px 36px;
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

		.form-card h1 {
			margin: 0 0 6px;
			font-size: 25px;
			font-weight: 700;
			text-align: center;
			background: linear-gradient(90deg, #a78bfa, #67e8f9);
			-webkit-background-clip: text;
			background-clip: text;
			color: transparent;
		}
		.form-card p.subtitle {
			margin: 0 0 26px;
			text-align: center;
			color: rgba(255,255,255,0.5);
			font-size: 13px;
		}

		.alert {
			padding: 10px 14px;
			border-radius: 10px;
			font-size: 13px;
			margin-bottom: 18px;
			background: rgba(239,68,68,0.15);
			color: #fca5a5;
			border: 1px solid rgba(239,68,68,0.3);
			animation: cardIn 0.4s ease;
		}

		.field { margin-bottom: 18px; }
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
		.field textarea {
			width: 100%;
			padding: 12px 14px;
			border: 1px solid rgba(255,255,255,0.15);
			border-radius: 10px;
			font-size: 14px;
			font-family: inherit;
			background: rgba(255,255,255,0.06);
			color: #fff;
			transition: border-color .25s, box-shadow .25s, background .25s;
		}
		.field textarea {
			resize: vertical;
			min-height: 90px;
		}
		.field input::placeholder,
		.field textarea::placeholder { color: rgba(255,255,255,0.3); }
		.field input:focus,
		.field textarea:focus {
			outline: none;
			border-color: #a78bfa;
			background: rgba(255,255,255,0.1);
			box-shadow: 0 0 0 4px rgba(167,139,250,0.18);
		}

		.row-2 {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 14px;
		}

		.btn-submit {
			width: 100%;
			padding: 13px;
			border: none;
			border-radius: 10px;
			background: linear-gradient(90deg, #7c3aed, #22d3ee);
			background-size: 200% auto;
			color: #fff;
			font-size: 15px;
			font-weight: 700;
			letter-spacing: 0.3px;
			cursor: pointer;
			margin-top: 4px;
			transition: background-position .5s ease, transform .15s ease, box-shadow .3s ease;
			box-shadow: 0 8px 20px rgba(124,58,237,0.35);
		}
		.btn-submit:hover {
			background-position: right center;
			box-shadow: 0 8px 26px rgba(34,211,238,0.4);
			transform: translateY(-1px);
		}
		.btn-submit:active { transform: translateY(0); }

		.back-link {
			margin-top: 22px;
			text-align: center;
			font-size: 13px;
		}
		.back-link a {
			color: #a78bfa;
			text-decoration: none;
			font-weight: 700;
			transition: color .2s;
		}
		.back-link a:hover { color: #67e8f9; }

		@media (max-width: 480px) {
			.row-2 { grid-template-columns: 1fr; }
		}
	</style>
</head>
<body>
	<div class="blob blob1"></div>
	<div class="blob blob2"></div>

	<div class="form-card">
		<h1>Add Product</h1>
		<p class="subtitle">Fill in the details below</p>

		<?php
		$session = $this->call->library('session');
		if ($session->flashdata('error')) {
			echo '<div class="alert">' . $session->flashdata('error') . '</div>';
		}
		?>

		<form action="" method="post">
			<div class="field">
				<label for="product_name">Product Name</label>
				<input type="text" name="product_name" id="product_name" placeholder="e.g. Wireless Mouse">
			</div>

			<div class="field">
				<label for="description">Description</label>
				<textarea name="description" id="description" placeholder="Short product description"></textarea>
			</div>

			<div class="row-2">
				<div class="field">
					<label for="price">Price</label>
					<input type="text" name="price" id="price" placeholder="0.00">
				</div>

				<div class="field">
					<label for="quantity">Quantity</label>
					<input type="text" name="quantity" id="quantity" placeholder="0">
				</div>
			</div>

			<button type="submit" class="btn-submit">Save Product</button>
		</form>

		<p class="back-link"><a href="<?= site_url('products'); ?>">← Back to Products</a></p>
	</div>
</body>
</html>
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Products</title>
	<style>
		* { box-sizing: border-box; }
		body {
			margin: 0;
			min-height: 100vh;
			font-family: 'Segoe UI', Arial, sans-serif;
			background: #0f0c29;
			background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e, #1b1136);
			background-size: 400% 400%;
			animation: gradientShift 16s ease infinite;
			position: relative;
			overflow-x: hidden;
			color: #fff;
			padding: 40px 20px 60px;
		}
		@keyframes gradientShift {
			0%   { background-position: 0% 50%; }
			50%  { background-position: 100% 50%; }
			100% { background-position: 0% 50%; }
		}

		.blob {
			position: fixed;
			border-radius: 50%;
			filter: blur(90px);
			opacity: 0.35;
			z-index: 0;
		}
		.blob1 { width: 340px; height: 340px; background: #7c3aed; top: -80px; left: -80px; animation: float1 12s ease-in-out infinite; }
		.blob2 { width: 300px; height: 300px; background: #22d3ee; bottom: -80px; right: -60px; animation: float2 14s ease-in-out infinite; }
		@keyframes float1 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(40px,30px); } }
		@keyframes float2 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(-30px,-40px); } }

		.wrap {
			position: relative;
			z-index: 1;
			max-width: 1100px;
			margin: 0 auto;
		}

		.page-header {
			display: flex;
			flex-wrap: wrap;
			gap: 16px;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 28px;
			animation: fadeIn 0.6s ease;
		}
		.page-header h1 {
			margin: 0;
			font-size: 28px;
			font-weight: 700;
			background: linear-gradient(90deg, #a78bfa, #67e8f9);
			-webkit-background-clip: text;
			background-clip: text;
			color: transparent;
		}
		.user-chip {
			display: flex;
			align-items: center;
			gap: 14px;
			background: rgba(255,255,255,0.06);
			border: 1px solid rgba(255,255,255,0.12);
			backdrop-filter: blur(12px);
			padding: 8px 16px;
			border-radius: 999px;
			font-size: 13.5px;
			color: rgba(255,255,255,0.75);
		}
		.user-chip a {
			color: #fca5a5;
			text-decoration: none;
			font-weight: 600;
		}
		.user-chip a:hover { color: #f87171; }

		@keyframes fadeIn {
			0% { opacity: 0; transform: translateY(-10px); }
			100% { opacity: 1; transform: translateY(0); }
		}

		.alert {
			padding: 12px 16px;
			border-radius: 10px;
			font-size: 13.5px;
			margin-bottom: 20px;
			animation: fadeIn 0.4s ease;
		}
		.alert-success { background: rgba(34,197,94,0.15); color: #6ee7a0; border: 1px solid rgba(34,197,94,0.3); }
		.alert-error   { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }

		.toolbar {
			margin-bottom: 20px;
		}
		.btn-add {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			padding: 11px 20px;
			border-radius: 10px;
			background: linear-gradient(90deg, #7c3aed, #22d3ee);
			background-size: 200% auto;
			color: #fff;
			text-decoration: none;
			font-size: 14px;
			font-weight: 700;
			box-shadow: 0 8px 20px rgba(124,58,237,0.35);
			transition: background-position .5s ease, transform .15s ease, box-shadow .3s ease;
		}
		.btn-add:hover {
			background-position: right center;
			box-shadow: 0 8px 26px rgba(34,211,238,0.4);
			transform: translateY(-1px);
		}

		.card {
			background: rgba(255, 255, 255, 0.06);
			backdrop-filter: blur(18px);
			-webkit-backdrop-filter: blur(18px);
			border: 1px solid rgba(255, 255, 255, 0.12);
			border-radius: 18px;
			box-shadow: 0 25px 60px rgba(0,0,0,0.4);
			overflow: hidden;
			animation: cardIn 0.6s cubic-bezier(.22,1,.36,1);
		}
		@keyframes cardIn {
			0% { opacity: 0; transform: translateY(20px) scale(0.98); }
			100% { opacity: 1; transform: translateY(0) scale(1); }
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 14px;
		}
		thead th {
			text-align: left;
			padding: 16px 18px;
			font-size: 11.5px;
			letter-spacing: 0.5px;
			text-transform: uppercase;
			color: rgba(255,255,255,0.5);
			background: rgba(255,255,255,0.04);
			border-bottom: 1px solid rgba(255,255,255,0.1);
		}
		tbody td {
			padding: 15px 18px;
			border-bottom: 1px solid rgba(255,255,255,0.07);
			color: rgba(255,255,255,0.9);
			vertical-align: middle;
		}
		tbody tr:last-child td { border-bottom: none; }
		tbody tr {
			transition: background .2s ease;
		}
		tbody tr:hover {
			background: rgba(255,255,255,0.04);
		}
		td.empty-row {
			text-align: center;
			padding: 40px 18px;
			color: rgba(255,255,255,0.4);
			font-style: italic;
		}

		.price-tag {
			font-weight: 700;
			color: #67e8f9;
		}
		.qty-badge {
			display: inline-block;
			padding: 3px 10px;
			border-radius: 999px;
			background: rgba(167,139,250,0.15);
			color: #c4b5fd;
			font-size: 12.5px;
			font-weight: 600;
		}

		.actions { display: flex; gap: 10px; align-items: center; }
		.btn-edit {
			padding: 7px 14px;
			border-radius: 8px;
			background: rgba(103,232,249,0.12);
			border: 1px solid rgba(103,232,249,0.3);
			color: #67e8f9;
			text-decoration: none;
			font-size: 12.5px;
			font-weight: 600;
			transition: background .2s ease;
		}
		.btn-edit:hover { background: rgba(103,232,249,0.22); }

		.btn-delete {
			padding: 7px 14px;
			border-radius: 8px;
			background: rgba(239,68,68,0.12);
			border: 1px solid rgba(239,68,68,0.3);
			color: #fca5a5;
			font-size: 12.5px;
			font-weight: 600;
			cursor: pointer;
			transition: background .2s ease;
		}
		.btn-delete:hover { background: rgba(239,68,68,0.22); }

		@media (max-width: 720px) {
			table, thead, tbody, th, td, tr { display: block; }
			thead { display: none; }
			tbody tr {
				margin-bottom: 14px;
				border-radius: 12px;
				background: rgba(255,255,255,0.03);
				border: 1px solid rgba(255,255,255,0.08);
			}
			tbody td {
				border-bottom: none;
				padding: 10px 16px;
			}
			tbody td::before {
				content: attr(data-label);
				display: block;
				font-size: 11px;
				text-transform: uppercase;
				color: rgba(255,255,255,0.4);
				margin-bottom: 4px;
			}
		}
	</style>
</head>
<body>
	<div class="blob blob1"></div>
	<div class="blob blob2"></div>

	<div class="wrap">
		<div class="page-header">
			<h1>Product Management</h1>

			<?php $session = $this->call->library('session'); ?>
			<div class="user-chip">
				<span>Logged in as <strong><?= $session->userdata('auth_username'); ?></strong></span>
				<a href="<?= site_url('logout'); ?>">Logout</a>
			</div>
		</div>

		<?php
		if ($session->flashdata('success')) {
			echo '<div class="alert alert-success">' . $session->flashdata('success') . '</div>';
		}
		if ($session->flashdata('error')) {
			echo '<div class="alert alert-error">' . $session->flashdata('error') . '</div>';
		}
		?>

		<?php if (($session->userdata('auth_role') ?? '') === 'admin') : ?>
			<div class="toolbar">
				<a href="<?= site_url('products/create'); ?>" class="btn-add">+ Add Product</a>
			</div>
		<?php endif; ?>

		<div class="card">
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Product Name</th>
						<th>Description</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Created At</th>
						<?php if (($session->userdata('auth_role') ?? '') === 'admin') : ?>
							<th>Actions</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($products)) : ?>
						<?php foreach ($products as $product) : ?>
						<tr>
							<td data-label="ID"><?= $product['id']; ?></td>
							<td data-label="Product Name"><?= $product['product_name']; ?></td>
							<td data-label="Description"><?= $product['description']; ?></td>
							<td data-label="Price"><span class="price-tag">₱<?= number_format((float) $product['price'], 2); ?></span></td>
							<td data-label="Quantity"><span class="qty-badge"><?= $product['quantity']; ?></span></td>
							<td data-label="Created At"><?= $product['created_at']; ?></td>
							<?php if (($session->userdata('auth_role') ?? '') === 'admin') : ?>
								<td data-label="Actions">
									<div class="actions">
										<a href="<?= site_url('products/edit/' . $product['id']); ?>" class="btn-edit">Edit</a>
										<form action="<?= site_url('products/delete/' . $product['id']); ?>" method="post" style="display:inline;" onsubmit="return confirm('Delete this product?');">
											<button type="submit" class="btn-delete">Delete</button>
										</form>
									</div>
								</td>
							<?php endif; ?>
						</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="<?= (($session->userdata('auth_role') ?? '') === 'admin') ? '7' : '6'; ?>" class="empty-row">No products found.<?php if (($session->userdata('auth_role') ?? '') === 'admin') : ?> Click "+ Add Product" to create one.<?php endif; ?></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
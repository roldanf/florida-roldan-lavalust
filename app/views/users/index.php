<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users</title>
</head>
<body>
	<h1>Users</h1>

	<table border="1" cellpadding="8" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Username</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $user) : ?>
			<tr>
				<td><?= $user['id']; ?></td>
				<td><?= $user['firstname']; ?></td>
				<td><?= $user['lastname']; ?></td>
				<td><?= $user['email']; ?></td>
				<td><?= $user['username']; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>
</html>

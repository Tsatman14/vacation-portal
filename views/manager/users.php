<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>
<body>
<h1>Manage Users</h1>
<a href="/views/manager/create_user.php">Create New User</a>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td>
                    <a href="/views/manager/edit_user.php?id=<?= $user['id'] ?>">Edit</a>
                    <form action="/routes.php?action=delete_user" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">No users found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<a href="/routes.php?action=logout">Logout</a>
</body>
</html>
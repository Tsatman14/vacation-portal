<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
<h1>Edit User</h1>
<form action="/routes.php?action=update_user&id=<?= $user['id'] ?>" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
    <button type="submit">Update</button>
</form>
<a href="/views/manager/users.php">Back to Users</a>
</body>
</html>
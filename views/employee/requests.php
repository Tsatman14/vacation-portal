<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacation Requests</title>
</head>
<body>
<h1>Vacation Requests</h1>
<a href="/views/employee/create_request.php">Create New Request</a>
<table>
    <thead>
    <tr>
        <th>Date Submitted</th>
        <th>Date Range</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($requests)): ?>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= htmlspecialchars($request['date_submitted']) ?></td>
                <td><?= htmlspecialchars($request['date_from']) ?> - <?= htmlspecialchars($request['date_to']) ?></td>
                <td><?= htmlspecialchars($request['reason']) ?></td>
                <td><?= htmlspecialchars($request['status']) ?></td>
                <td>
                    <?php if ($request['status'] === 'pending'): ?>
                        <form action="/routes.php?action=delete_request" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $request['id'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No requests found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<a href="/routes.php?action=logout">Logout</a>
</body>
</html>
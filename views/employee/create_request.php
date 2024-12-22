<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Vacation</title>
</head>
<body>
<h1>Request Vacation</h1>
<form action="/routes.php?action=create_request" method="POST">
    <label for="date_from">Start Date:</label>
    <input type="date" name="date_from" id="date_from" required>
    <br>
    <label for="date_to">End Date:</label>
    <input type="date" name="date_to" id="date_to" required>
    <br>
    <label for="reason">Reason:</label>
    <textarea name="reason" id="reason" required></textarea>
    <br>
    <button type="submit">Submit Request</button>
</form>
</body>
</html>

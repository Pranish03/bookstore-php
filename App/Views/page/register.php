<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore | Register</title>
</head>

<body>
    <h1>Register</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php
    $errors   = $_SESSION['errors'] ?? [];
    $oldInput = $_SESSION['old_input'] ?? [];
    unset($_SESSION['errors'], $_SESSION['old_input']);
    ?>

    <?php if (!empty($errors['general'])): ?>
        <p style="color: red;"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>

    <form action="/register" method="POST">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"
                value="<?= htmlspecialchars($oldInput['name'] ?? '') ?>">
            <?php if (!empty($errors['name'])): ?>
                <span style="color: red;"><?= htmlspecialchars($errors['name']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>">
            <?php if (!empty($errors['email'])): ?>
                <span style="color: red;"><?= htmlspecialchars($errors['email']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <?php if (!empty($errors['password'])): ?>
                <span style="color: red;"><?= htmlspecialchars($errors['password']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <?php if (!empty($errors['confirm_password'])): ?>
                <span style="color: red;"><?= htmlspecialchars($errors['confirm_password']) ?></span>
            <?php endif; ?>
        </div>
        <button type="submit">Register</button>
    </form>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore | Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php
    $errors   = $_SESSION['errors'] ?? [];
    $oldInput = $_SESSION['old_input'] ?? [];
    unset($_SESSION['errors'], $_SESSION['old_input']);
    ?>

    <?php if (!empty($errors['general'])): ?>
        <p style="color: red;"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>

    <form action="/login" method="POST">
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

        <button type="submit">Login</button>
    </form>

</body>

</html>
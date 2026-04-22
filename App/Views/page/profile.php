<?= start_layout(); ?>

<?php
$errors = $_SESSION['errors']    ?? [];
$old    = $_SESSION['old_input'] ?? [];

unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<?php if (!empty($_SESSION['success'])): ?>
    <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<section>
    <h2>Profile Picture</h2>

    <?php if (!empty($errors['avatar'])): ?>
        <p style="color:red"><?= htmlspecialchars($errors['avatar']) ?></p>
    <?php endif; ?>

    <?php if (!empty($user['profile'])): ?>
        <img src="/<?= htmlspecialchars($user['profile']) ?>"
            alt="Profile picture" width="100" height="100">
    <?php else: ?>
        <p>No profile picture set.</p>
    <?php endif; ?>

    <form action="/profile/upload-avatar" method="POST" enctype="multipart/form-data">
        <div>
            <label for="avatar">Upload picture (JPG, PNG, WEBP — max 2MB):</label>
            <input type="file" id="avatar" name="avatar"
                accept="image/jpeg,image/png,image/webp">
        </div>
        <button type="submit">Upload</button>
    </form>

    <?php if (!empty($user['profile'])): ?>
        <form action="/profile/remove-avatar" method="POST"
            onsubmit="return confirm('Remove your profile picture?')">
            <button type="submit">Remove Picture</button>
        </form>
    <?php endif; ?>
</section>

<hr>

<section>
    <h2>Account Info</h2>

    <form action="/profile/update-info" method="POST">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"
                value="<?= htmlspecialchars($old['name'] ?? $user['name']) ?>">
            <?php if (!empty($errors['name'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['name']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                value="<?= htmlspecialchars($old['email'] ?? $user['email']) ?>">
            <?php if (!empty($errors['email'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['email']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Save Changes</button>
    </form>
</section>

<hr>

<section>
    <h2>Change Password</h2>

    <form action="/profile/change-password" method="POST">
        <div>
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password">
            <?php if (!empty($errors['current_password'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['current_password']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">
            <?php if (!empty($errors['new_password'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['new_password']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <?php if (!empty($errors['confirm_password'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['confirm_password']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Change Password</button>
    </form>
</section>

<?= end_layout('app'); ?>
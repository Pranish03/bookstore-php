<?= start_layout(); ?>

<div>
    <a href="/admin/users">Back to users</a>

    <h1><?= htmlspecialchars($user['name']) ?></h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <p style="color:red"><?= htmlspecialchars($_SESSION['error']) ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <p>Role: <?= $user['is_admin'] ? 'Admin' : 'Customer' ?></p>
    <p>Joined: <?= date('M d, Y', strtotime($user['created_at'])) ?></p>

    <?php if ((int) $user['id'] !== (int) $_SESSION['user']['id']): ?>
        <form action="/admin/users/<?= $user['id'] ?>/toggle-admin" method="POST">
            <button type="submit">
                <?= $user['is_admin'] ? 'Revoke Admin' : 'Make Admin' ?>
            </button>
        </form>

        <form action="/admin/users/<?= $user['id'] ?>" method="POST"
            onsubmit="return confirm('Delete this user? This cannot be undone.')">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">Delete User</button>
        </form>
    <?php else: ?>
        <p><em>This is your account.</em></p>
    <?php endif; ?>
</div>

<?= end_layout('admin'); ?>
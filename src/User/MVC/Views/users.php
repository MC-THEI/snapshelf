<?php
require_once __DIR__ . "/../../../App/Design/header.php";
?>

<div class="users_container">
    <h2>Users</h2>
    <?php foreach ($users as $user): ?>
        <a href="/Snapshelf/user?user=<?php echo $user->userId ?>">
            <h4><?php echo $user->userName ?></h4>
        </a>
    <?php endforeach; ?>
</div>

<?php
require_once __DIR__ . "/../../../App/Design/footer.php";
?>
<?php

require_once __DIR__ . "/../../../App/Design/header.php";


if (!empty($user)): ?>

    <h3><?php echo $user['userName'] ?></h3>
    <p><?php echo $user['email'] ?></p>
    <p><?php echo $user->bio ?></p>
    <p><?php echo $birthYear ?></p>
    <p><?php echo $user->getStrlen($user->bio) ?></p>

<?php endif;


require_once __DIR__ . "/../../../App/Design/footer.php";

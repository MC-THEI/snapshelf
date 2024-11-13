<?php require_once __DIR__ . "/../../../App/Design/header.php"; ?>
<?php require_once __DIR__ . "/../../../Components/navbar.php"; ?>

<div class="container mt-5">
    <h1 class="mb-4"><?php echo $album->albumName; ?></h1>
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0" id="column1"></div>
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0" id="column2"></div>
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0" id="column3"></div>

        <?php
        $columns = [[], [], []];
        $columnIndex = 0;

        foreach ($photos as $photo) {
            $altText = !empty($photo['alt']) ? htmlspecialchars($photo['alt'], ENT_QUOTES, 'UTF-8') : "Bildbeschreibung nicht verfügbar";

            $columns[$columnIndex][] = "
                <img
                    src=\"'../../../../../Snapshelf/src/UploadFiles/{$photo['photoName']}\"
                    class=\"w-100 shadow-1-strong rounded mb-4\"
                    alt=\"$altText\"
                    loading=\"lazy\"
                />
            ";

            $columnIndex = ($columnIndex + 1) % 3;
        }

        for ($i = 0; $i < 3; $i++) {
            echo "<div class=\"col-lg-4 col-md-12 mb-4 mb-lg-0\">";
            foreach ($columns[$i] as $imageHtml) {
                echo $imageHtml;
            }
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php require_once __DIR__ . "/../../../App/Design/footer.php"; ?>

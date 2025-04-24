<?php
$sql = "SELECT id, heading, preamble, photo, DATE_FORMAT(added, '%d.%m.%Y') AS estonia FROM blog ORDER BY added DESC";
$data = $db->dbGetArray($sql);

if($data !== false) {
    $counter = 0;

    foreach($data as $post) {
        if($counter % 3 === 0) {
            echo '<div class="row mb-4">';
        }
        ?>
        <div class="col-md-4">
            <div class="card h-100 shadow">
                <img src="<?= htmlspecialchars($post['photo']) ?>" class="card-img-top" alt="<?= htmlspecialchars($post['heading']) ?>">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= htmlspecialchars($post['heading']) ?></h5>
                    <p class="text-muted"><?= $post['estonia'] ?></p>
                    <p class="card-text"><?= htmlspecialchars($post['preamble']) ?></p>
                    <div class="mt-auto">
                        <a href="?page=post&sid=<?= $post['id'] ?>" class="btn btn-primary">Loe edasi</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $counter++;
        if($counter % 3 === 0) {
            echo '</div>';
        }
    }

    // Kui viimases reas polnud täpselt 3 kaarti, sulgeme rea
    if($counter % 3 !== 0) {
        echo '</div>';
    }
} else {
    echo "<div class='alert alert-warning'>Ühtegi postitust ei leitud.</div>";
}
?>

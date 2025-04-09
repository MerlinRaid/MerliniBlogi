<?php
if(isset($_GET['sid']) && is_numeric($_GET['sid'])) { //Kui on olemas ja number
    $id = (int)$_GET['sid']; //Võtame url id väärtuse tehes täisarvuks
    $sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') AS adding FROM blog WHERE id = ".$id; //SQL lause
    $data = $db->dbGetArray($sql); //Teeb päringu
    if($data !== false) { //Kui andmed leiti
        $val = $data[0]; //Võtame esimese postituse
    //$db->show($val); //Näita postituse andmeid
   


?>

<div class="container my-5">
    <div class="card shadow p-4">
  
        <h1 class="mb-3"><?php echo $val['heading']; ?></h1>

        <p class="text-muted">Avaldatud: <strong><?php echo $val['adding']; ?></strong> | Autor: <strong>Merlin Raid</strong></p>

        <img src="<?php echo $val['photo']; ?>" class="img-fluid rounded mb-4">

        <p><?php echo $val['context']?></p>
        
        <div class="tags mt-2">
            <?php
                $tags = array_map('trim', explode(",", $val['tags']));
                $links = [];
                foreach ($tags as $tag) {
                    $safeTag = htmlspecialchars($tag);
                    $links[] = "<a href='?tag={$safeTag}' class='badge bg-secondary mx-1'>{$safeTag}</a>";
                }
                echo implode("", $links);
            ?>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="?page=post2" class="btn btn-primary">Eelmine postitus &rarr;</a>
        </div>
</div>

<?php
    } else {
        echo "<h4>Viga</h4>";
        echo "<p>Sellist postitust ei ole!</p>";
    }
} else {
?>
<h4>VIGA</h4>
<p>URL on vigane</p>
<?php
}
?>



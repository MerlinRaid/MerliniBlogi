<?php
if(isset($_GET['sid']) && is_numeric($_GET['sid'])) { //Kui on olemas ja number
    $id = (int)$_GET['sid']; //Võtame url id väärtuse tehes täisarvuks
    $sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') AS adding FROM blog WHERE id = ".$id; //SQL lause
    $data = $db->dbGetArray($sql); //Teeb päringu
    if($data !== false) { //Kui andmed leiti
        $val = $data[0]; //Võtame esimese postituse
    //$db->show($val); //Näita postituse andmeid
   

    $sql_prev = "SELECT id from blog where added > '". $val['added'] . "' ORDER BY added asc LIMIT 1";
    $prev = $db->dbGetArray($sql_prev);
    $sql_next = "SELECT id FROM blog WHERE added < '". $val['added'] . "' ORDER BY added desc LIMIT 1";
    $next = $db->dbGetArray($sql_next);
    // echo $prev[0]['id']." ".$next[0]['id'];

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
                $result = implode(",", $links); // Ühenda listi elemendid komaga
                echo $result; // väljasta tulemus;
            ?>
        </div>

        <div class="container mt-4">
            <div class="row justify-content-between">
                <?php
                // EElmine nupp
                if($prev !== false){
                    ?>
                    <div class="col-md-4">
                        <a class="btn btn-outline-primary w-10" href="?page=post&sid=<?=$prev[0]['id']; ?>">Eelmine postitus</a>
                    </div>
                    <?php
                }
                // Järgmine postitus
                if($next !== false){
                    ?>
                    <div class="col-md-4 text-end">
                         <a class="btn btn-outline-primary w-10" href="?page=post&sid=<?=$next[0]['id']; ?>">Järgmine postitus</a>
                    </div>
                    <?php
                }
                ?>
                
                    
                </div>
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



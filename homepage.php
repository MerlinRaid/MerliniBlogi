<?php
$sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') AS estoniatime FROM blog ORDER BY added DESC LIMIT 3"; //Kuva avalhele 3 viimast postitust
$data = $db->dbGetArray($sql); //Teeb päringu
//$db->show($data); // TEST Näita tulemusi
?>

<div class="container text-center my-5">
    <h1>Tere tulemast Merlini blogisse!</h1>
    <h4>
        Siin räägime juhtimisest, psühholoogiast ja elust loomariigi tarkuse kaudu.
        Kas juhina peaksid olema nutikas nagu ahv, lojaalne nagu koer, iseseisev nagu kass või strateegiline nagu hunt?
        Või hoopis tasakaalukas ja töökas nagu siga?
        Avasta, kuidas erinevad loomade omadused peegelduvad juhtimises, elus ja äris!
    </h4>
</div>

<div class="row mt-3">
    <?php
    if ($data !== false) { //Kui andmed leiti
        foreach ($data as $key => $val) { //Iga postituse kohta
    ?>
            <div class="container text-center my-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <a href="?page=post&sid=<?= $val['id']; ?>" class="content-box d-block">
                            <img src="<?php echo $val['photo']; ?>" class="img-fluid">
                            <h2><?php echo $val['heading']; ?></h2>
                            <h8><?php //echo $val['estoniatime']; ?></h8>
                            <span><?php echo $val['preamble']; ?></span>
                        </a> 

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
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>Postitusi ei leitud!</p>";
    }
    ?>
</div>

<div class="container text-center my-5">
    <div class="row">
        <!-- Kontakt -->
        <div class="col-md-6">
            <a href="?page=contact" class="content-box d-block">
                <img src="img/kontakt.png" alt="Kontakt" class="img-fluid">
                <h2>Kontakt</h2>
                <p>Võta meiega julgelt ühendust!</p>
            </a>
        </div>
        <!-- Blogi -->
        <div class="col-md-6">
            <a href="?page=blog" class="content-box d-block">
                <img src="img/blogipilt.png" alt="Blogi" class="img-fluid">
                <h2>Blogi</h2>
                <p>Loe kogu blogi ja saa palju huvitavat infot!</p>
            </a>
        </div>
    </div>
</div>

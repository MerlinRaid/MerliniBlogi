<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $db->show($_POST); //Vormist saadud andmed
    // $db->show($_FILES);   //Näita faili infot

    // Tekstifailide olemasolu ja tühjuse kontroll
    $heading = trim($_POST['heading'] ?? ''); //Pealkiri
    $preamble = trim($_POST['preamble'] ?? ''); //Sissejuhatus
    $context = trim($_POST['context'] ?? ''); //Postituse sisu
    $tags = trim($_POST['tags'] ?? ''); //Sildid

    $errors = []; //Tühja massi loomine

    if($heading === '') {$errors[] = 'Pealkiri on nõutud!';} //Pealkiri on nõutud
    if($preamble === '') {$errors[] = 'Sissejuhatus on nõutud!';} //Sissejuhatus on nõutud
    if($context === '') {$errors[] = 'Postituse sisu on nõutud!';} //Postituse sisu on nõutud
    if($tags === '') {$errors[] = 'Sildid on nõutud!';} //Sildid on nõutud

    //Failide olemas olu ja kontroll
    if(!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Faili üleslaadimine nurjus!'; //Faili üleslaadimine nurjus
    } else {
        $image = $_FILES['photo']; //Faili info
        //Failinime normalierimine
        $origName = basename($image['name']); //Ainult nimi . laiend
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION)); //Laiend

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp']; //Lubatud laiendid
        if(!in_array($ext, $allowed)) { //Kui ei ole lubatud laiend
            $errors[] = 'Lubatud on ainult: ' . implode(',', $allowed); //Lubatud on ainult JPG, JPEG, PNG, GIF ja WEBP failid
        }

        $normalizedName = preg_replace('/[^a-z0-9_\-\.]/i', '_', pathinfo($origName, PATHINFO_FILENAME)); //Normaliseeritud failinimi
        $filename = $normalizedName . '_' . time() . '.' . $ext; //Failinimi
    }

        //Kui pole vigu pole, siis töötle ja salvesta
    if(empty($errors)) { 
        $heading = htmlspecialchars($heading); //Pealkiri
        $preamble = htmlspecialchars($preamble); //Sissejuhatus
        $context = htmlspecialchars($context); //Postituse sisu
        $tags = htmlspecialchars($tags); //Sildid

        $uploadPath = UPLOAD_IMAGES . $filename; //Faili tee images/lilled.jpg
        move_uploaded_file($image['tmp_name'], $uploadPath); //Tõsata tmp kaustast soovitud kohta

        //Tee SQL lause andmebaasi lisamiseks
        $sql = "INSERT INTO blog (heading, preamble, context, tags, photo) VALUES (
            '".$db->dbFix($heading)."',
            '".$db->dbFix($preamble)."',
            '".$db->dbFix($context)."',
            '".$db->dbFix($tags)."',
            '".$db->dbFix($uploadPath)."')"; //SQL lause

        // echo $sql; //Näita SQL lauset, kontroll enne edasi kirjutamist 

        if($db->dbQuery($sql)) { //Kui päring õnnestus
            echo "<div class='alert alert-success' role='alert'>Postitus on edukalt lisatud!</div>"; //Näita edukat sõnumit
        } else {
            echo "<div class='alert alert-danger' role='alert'>Postituse lisamine nurjus!</div>"; //Näita nurjunud sõnumit
        }
    } else {
        //Leiti vigu ($errors)
        echo "<div class='alert alert-danger' role='alert'> <ul>";
        foreach($errors as $error) {
            echo "<li>" .htmlspecialchars($error)."</li>"; //Näita viga
        }
        echo "</ul></div>";
    }
}
?>

<div class="container my-4"> 
    <div class="row g-3">
    <div class="col-md-3"></div>
        <div class = "card p-2 shadow">
            <h2 class = "text-center">Uus postitus</h2>
            <form action="?page=post_add" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="heading" class="form-label fw-bold">Pealkiri</label>
                    <input type="text" class="form-control" id="heading" name="heading" placeholder="Pealkiri" required>
                </div>

                <div class="mb-3">
                    <label for="preamble" class="form-label fw-bold">Sissejuhatus</label>
                    <textarea name="preamble" class="form-control" id="preamble" rows="3" maxlength="200" placeholder="Sissejuhatus" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="context" class="form-label fw-bold">Postituse Sisu</label>
                    <textarea name="context" class="form-control" id="context" rows="3" placeholder="Postituse Sisu" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label fw-bold">Sildid</label>
                    <input type="text" class="form-control" maxlength="50" id="tags" name="tags" placeholder="Sildid, eralda komaga" required>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label fw-bold">Pildid</label>
                    <input type="file" class="form-control" id="photo" name="photo" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-danger" >Tühjenda vorm</button>
                    <button type="submit" class="btn btn-success" >Sisesta postitus</button>
                </div>
            </form>
        </div>
    </div>
</div>
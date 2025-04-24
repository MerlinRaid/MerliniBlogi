<?php 
include ('include/settings.php'); //Seadistused
include ('include/mysqli.php'); //Andmebaasi ühendus
$db = new Db(); //Loome andmebaasi objekti


$page = isset($_GET['page']) ? $_GET['page'] : 'homepage' ; #Kui olema page siis võtab selle, kui ei siis võtab index faili
$allowed_pages = ['homepage', 'blog', 'contact', 'post', 'post_add', 'post_edit', 'edit']; //.html failid
if(!in_array($page, $allowed_pages)){
    $page = 'homepage';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Merlin Blogi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
    <div class="container">
        <?php include 'navbar.html'; ?>
    </div>
  
    <div class="container">
        <?php include("$page.php") ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html> 
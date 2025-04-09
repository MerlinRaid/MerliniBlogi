<!--   <style>
        a {
            text-decoration: none;
            color: black;
        }
    </style> -->
    
<!-- Kontakt Sektsioon -->
<section class="mb-4">
    <div class="container">
        <h2 class="h1-responsive font-weight-bold text-center my-4">Võta meiega ühendust!</h2>
        <p class="text-center w-responsive mx-auto mb-5">
            Kui sul on mõni põnev lugu rääkida, soovid teha koostööd või tekkis küsimusi, siis võta meiega julgelt ühendust!
        </p>

        <div class="row">
            <!-- Vasak pool - Kontaktvorm -->
            <div class="col-md-6">
                <form id="contact-form" name="contact-form" action="mail.php" method="POST">
                    <div class="mb-1">
                        <label for="name" class="form-label">Nimi</label>
                        <input id="name" name="name" class="form-control" placeholder="Sinu nimi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Sinu sõnum</label>
                        <textarea id="message" name="message" rows="4" class="form-control" placeholder="Siia kirjuta oma sõnum...."></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Saada</button>
                    </div>
                </form>
            </div>

            <!-- Parem pool - Kontaktandmed ja Sotsiaalmeedia -->
            <div class="col-md-6 text-center">
                <ul class="list-unstyled">
                    <li>
                        <img src="img/inimene.png" alt="Inimese logo" class="img-fluid" style="height: 25px">
                        <p>Merlin Raid</p>
                    </li>
                    <li>
                        <img src="img/telefon.png" alt="Telefoni logo" class="img-fluid" style="height: 25px">
                        <p>+372 5118681</p>
                    </li>
                    <li>
                        <img src="img/email.png" alt="Email logo" class="img-fluid" style="height: 25px">
                        <p>merlin@blogi.com</p>
                    </li>
                </ul>

                <!-- Sotsiaalmeedia lingid -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://www.instagram.com/merlinraid/">
                        <img src="img/instagram.png" alt="Instagram Logo" class="img-fluid" style="height: 25px">
                    </a>
                    <a href="https://www.facebook.com/merlin.raid">
                        <img src="img/facebook.png" alt="Facebook Logo" class="img-fluid" style="height: 25px">
                    </a>
                    <a href="https://www.linkedin.com/in/merlinraid/">
                        <img src="img/linkedin.png" alt="LinkedIn Logo" class="img-fluid" style="height: 25px">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

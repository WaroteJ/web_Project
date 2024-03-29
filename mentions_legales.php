<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Site du BDE CESI, accès aux évènements et aux boutiques des différents BDE">
  <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>BDE CESI <?php echo $_SESSION['nomCentre']?> Mentions légales</title>
</head>
<body>
    <?php include ('php/menu.php');?>
    <main>
        <a href="index.php">Acceuil</a>
        <h2>Éditeur : Association CESI</h2>
        <div>
            SIREN : 775 722 572<br>
            Siège social :<br>
            1, avenue du Général de Gaulle<br>
            Tour PB5<br>
            92074 Paris La Défense<br>
            Tél : 01 44 45 92 00<br>
            Fax : 01 44 45 92 98<br>
            e-mail : contact@cesi.fr
        </div>
        <h2>Développement & hébergement</h2>
        <p>
            Poisson Bouge, laboratoire de contenus web dynamiques<br>
            7, rue des Cadeniers<br>
            44000 Nantes<br>
            09 51 71 39 39<br>
            e-mail : contact@poissonbouge.fr
        </p>
        <h2>Respect de la vie privée et collecte des Données Personnelles</h2>
        <p>
            Soucieux de protéger la vie privée de ses clients, CESI s’engage dans la protection des données personnelles. Une politique sur la protection des données personnelles rappelle nos principes et nos actions visant au respect de la réglementation applicable en matière de protection des données à caractère personnel.
        </p>
        <p>
            Pour lire l’intégralité de notre politique sur la Protection des données personnelles cliquez-ici
        </p>
        <h2>Sécurité</h2>
        <p>
            Le CESI s’engage à mettre en œuvre tous les moyens nécessaires au bon fonctionnement du site. Cependant, le CESI ne peut pas garantir la continuité absolue de l’accès aux services proposés par le site. Les adhérents sont informés que les informations et services proposés sur le site pourront être interrompus en cas de force majeure et pourront le cas échéant contenir des erreurs techniques.
        </p>
        <h2>Déclarations d’activité</h2>
        <div>
            <p>
                CESI SAS – Société par actions simplifiée au capital de 1.1M€<br>
                342 707 502<br>
                1, avenue du Général de Gaulle – Tour PB5 – 92074 Paris La Défense<br>
                Tél. : +33(0) 1 44 19 23 45 – Fax : +33(0) 1 42 50 25 06<br>
                Déclaration d’activité enregistrée sous le numéro 11 75 39666 75 auprès du Préfet de la région Ile-de-France.<br>
                Cet enregistrement ne vaut pas agrément de l’État.
            </p>
            <p>
                CESI – association loi de 1901<br>
                775 722 572<br>
                1, avenue du Général de Gaulle – Tour PB5 – 92074 Paris La Défense<br>
                Tél. : +33(0) 1 44 19 23 45 – Fax : +33(0) 1 42 50 25 06<br>
                Déclaration d’activité enregistrée sous le numéro 11 75 47883 75 auprès du Préfet de la région Ile-de-France.<br>
                Cet enregistrement ne vaut pas agrément de l’État.
            </p>
        </div>
    </main>
    <?php include ('php/footer.php');?>
</body>
</html>
<nav>
    <div class="container-fluid">  
      <div class="row">
      
          <!-- Add tab admin for the connected members with admin status -->
          <?php
          $centre = isset($_SESSION['centre'])? $_SESSION['centre'] : NULL;
          $admin = isset($_SESSION['admin'])? $_SESSION['admin'] : NULL;
          if($admin == 2 && $centre != NULL){
              echo '<a href="admin.php" class="col menu">Administration</a>'; 
          }
          /* If not connected send back on the home page and show the menu of it*/
          if($centre == NULL){
          echo '<a href="index.php" class="col menu"> Accueil </a>
           <a href="login.php" class="col menu"> Connexion </a>
           <a href="register.php" class="col menu"> Inscription </a>';
          /* If connected then show the center page and show the menu of it*/  
          }else{
              echo '<a href="centre.php" class="col menu"> Accueil </ a>
              <a href="evenements.php" class="col menu"> Evénements </ a>
              <a href="boutique.php" class="col menu"> Boutique </ a>
              <a href="php/disconnect.php" class="col menu"> Déconnexion </a>';
          }?>
        </ul>
       </div>
    </div>
</nav>
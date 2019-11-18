<nav>
    <div class="container-fluid">  
      <div class="row nav_menu">
      
          <!-- Add tab admin for the connected members with admin status -->
          <?php
          $centre = isset($_SESSION['centre'])? $_SESSION['centre'] : NULL;
          $admin = isset($_SESSION['admin'])? $_SESSION['admin'] : NULL;
          /* If not connected send back on the home page and show the menu of it*/
          if($centre == NULL){

            echo '<a href="noLog.php" class="col-md-2 col-sm-3 col-12 menu menu_logo"> <img class="w-100" src="assets/img/site/cesi_logo.png" alt="logo"> </a>
           <a href="login.php" class="col-md col-sm col-12 menu"> Connexion </a>
           <a href="register.php" class="col-md col-sm col-12 menu"> Inscription </a>';
          /* If connected then show the center page and show the menu of it*/  
          }else{
              echo '<a href="centre.php" class="col-md-2 col-sm-3 col-12 menu menu_logo"> <img class="w-100" src="assets/img/site/cesi_logo.png" alt="logo"> </a>
              <a href="evenements.php" class="col-md col-sm col-12 menu"> Evénements </ a>
              <a href="boutique.php" class="col-md col-sm col-12 menu"> Boutique </ a>';
              if($admin == 2 && $centre != NULL){
                echo '<a href="admin.php" class="col menu">Administration</a>'; 
            }
              echo '<a href="php/disconnect.php" class="col-md col-sm col-12 menu"> Déconnexion </a>';
          }
        ?>
        </ul>
       </div>
    </div>
</nav>
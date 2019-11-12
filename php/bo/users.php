<table id="user_table">
  <tr>
    <th>Nom</th>
    <th>Prénom</th> 
    <th>Permission</th>
    <th>Modifier</th>
  </tr>
<?php

  if(isset($_POST["id"],$_POST["droit"])){ // Si un bouton modifier a été cliqué 
    $req = $bdd->prepare("UPDATE `user` SET `droit`=:droit WHERE `id`=:id"); // modifie le droit de l'utilisateur
    $req->execute(array(
        ':id'=>inputSecure($_POST["id"]),
        ':droit'=>inputSecure($_POST["droit"])
    )); 
    $req->closeCursor();
  }

  $requete = $bdd->prepare("SELECT `id`,`nom`,`prenom`,`droit` FROM `user` WHERE `id_Centre`=:id");
  $requete->execute(array(
      ':id'=>$_SESSION['centre']
  ));
  while($result = $requete->fetch(PDO::FETCH_BOTH)){ //Affiche le nom, prénom, droit + un bouton modifier pour tous les utilisateurs
  echo'<tr>
          <td>'.$result[1].'</td> 
          <td>'.$result[2].'</td>
          <td>';
          if($_SESSION['user']!=$result[0]){
          echo'  
          <form class="users_form" method="post">
              <select name="droit" id="droit" required>
                  <option value="0"';if($result[3]==0){echo 'selected="selected"';}echo '>0</option>"; 
                  <option value="1"';if($result[3]==1){echo 'selected="selected"';}echo '>1</option>";
                  <option value="2"';if($result[3]==2){echo 'selected="selected"';}echo '>2</option>";
              </select>
              <input type="hidden" name="id" class="id" value="'.$result[0].'">
          </td>
          <td><input type="submit" value="Modifier" name="user_modify"></td>
          </form>';
          }else{
            echo $result[3].'</td>
            <td>Vous ne pouvez pas modifier vos droits</td>';
          }
  echo'</tr>';
  }
  $requete->closeCursor();
?>
</table>
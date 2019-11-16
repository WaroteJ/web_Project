$(function(){
  let adresse = window.location.href;
  let id_art;
  let result = adresse.split('/');
  if (result[3] == "web_project"){
    id_art = result[4].split('=');
  }

  let article='http://localhost:3000/articles/'+ id_art[1];
  $.ajax({
    type:'GET',
    url: article,
    dataType:'json'
  })
  .done(function(data){
    let donnees = typeof data !='object' ? JSON.parse(data) : data;
    // let addPanier = "<div class ='filtre'><form action='php/addPanier.php'><label for='qte'>Quantité</label><input type='number' name='qte' min='1' max='100'><input type='hidden' value='"+id_art[1]+"' name='id_art'><input type='submit' value='Ajouter'></form></div>"
    $("#qte_art").val(id_art[1]);
    
    $(".article").prepend('<div class="article_b col"><img class="picture"src= "'+ donnees[0].url +'" width=60%><div class="description text-white">Prix: '+ donnees[0].prix +'€</div><div class="description text-white">Nom: '+donnees[0].nom_article+'</div></div></div>');
  })              
  .fail(function(jqXHR, textStatus, err){
    console.log('AJAX error response:', textStatus);
  });
});
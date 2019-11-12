$(function(){
  let url = window.location.href;
  var pathname = window.location.pathname; // Returns path only (/path/example.html)
  console.log(url);
  console.log(pathname);

  //let $url = 'http://localhost:3000/articles/'
  $.ajax({
    type:'GET',
    url: 'http://localhost:3000/articles/',
    dataType:'json'
  })
  .done(function(data){
    let donnees = typeof data !='object' ? JSON.parse(data) : data;

    for(let i=0;i<donnees.length;i++){
    $(".articles").append('<div class="col-5 article"><a href=articles.php?art='+ donnees[i].id +'><img class="picture"src= "'+ donnees[i].url +'" width=60%><div class="description">Prix: '+ donnees[i].prix +'€</div><div class="description">Nom: '+donnees[i].nom_article+'</div></div></div></div>');
  }              
  })
  .fail(function(jqXHR, textStatus, err){
    console.log('AJAX error response:', textStatus);
    });
})
 
$(function(){
  $.ajax({
    type:'GET',
    url: 'http://localhost:3000/articles/up',
    dataType:'json'
  })
  .done(function(data){
    let donnees = typeof data !='object' ? JSON.parse(data) : data;
    for(let i=0;i<donnees.length;i++){
    $(".results").append('<div class="col-5 article"><a href=articles.php?art='+donnees[i].id +'><img class="picture"src= "'+ donnees[i].url +'" width=60%><div class="description">Prix: '+ donnees[i].prix +'€</div><div class="description">Nom: '+donnees[i].nom_article+'</div></div></div></div>');
   }       
              
  })
  .fail(function(jqXHR, textStatus, err){
    console.log('AJAX error response:', textStatus);
    });
  alert('ready');
    $.ajax({
      type:'GET',
      url: 'http://localhost:3000/articles/carousel',
      dataType:'json'
    })
    .done(function(data){
      let donnees = typeof data !='object' ? JSON.parse(data) : data;
      for(let i=0;i<donnees.length;i++){
        alert(donnees[i].url);
     // $(".carousel-inner").append('<div class="carousel-item active "><img src="https://www.comptoir-irlandais.com/12804-large_default/pull-lambswool-rond-orange-celtic-alliance.jpg" class="d-block w-50" alt=top'+i+'></div>');
     }       
                
    })
    .fail(function(jqXHR, textStatus, err){
      console.log('AJAX error response:', textStatus);
      });
  })


$(":checkbox").on('click', function() {
   $(".results").empty();
  let $wt, $block,i=0;
  // in the handler, 'this' refers to the box clicked on
  let $box = $(this);
  //console.log($box.attr("id"));
  if ($box.is(":checked")) {
  // as it is assumed and expected to be immutable
    let group = "input:checkbox[name='" + $box.attr("name") + "']";
  // the checked state of the group/box on the other hand will change
  // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }

  let url = 'http://localhost:3000/articles/' + $box.attr("id");

  $.ajax({
  type:'GET',
  url: url ,
  dataType:'json'
  })
  .done(function(data){

    let donnees = typeof data !='object' ? JSON.parse(data) : data;
    for(let i=0;i<donnees.length;i++){    
      $(".results").append('<div class="col-5 article"><a href=articles.php?art='+donnees[i].id +'><img class="picture"src= "'+ donnees[i].url +'" width=60%><div class="description">Prix: '+ donnees[i].prix +'€</div><div class="description">Nom: '+donnees[i].nom_article+'</div></div></div></div>');
   }
    
  })
  .fail(function(jqXHR, textStatus, err){
      console.log('AJAX error response:', textStatus);
    });
});

$("#panier").on('click', function() {
  window.location.href = "http://localhost/web_project/panier.php";
})





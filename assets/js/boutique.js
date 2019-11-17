$(function(){
  // Get the user's centre
  let centre = $('#centre').val();

  // Ajax request
  function ajax_call(form,url){
    $.ajax({
      // Http verb
      type:'GET',
      // Route result that we want
      url: url ,
      dataType:'json'
    })
    .done(function(data){
      // Translate the data into an js object 
      let donnees = typeof data !='object' ? JSON.parse(data) : data;
      // Different data processing depending of the objective   
      if(form == "carousel"){
        for(let i=0;i<donnees.length;i++){
          $(".carousel-inner").append('<div class="carousel-item "><img src="' +donnees[i].url+'" class="d-block w-50 mx-auto" alt=top'+i+'></div>');
        }
        // Initializing the first carousel's picture 
      $(".carousel-inner :nth-child(1)").addClass("active"); 
      }else if (form == "article"){
        for(let i=0;i<donnees.length;i++){  
          let spanC; 
          if($('#admin').val() == 0 ||$('#admin').val() == 1 ){
            spanC=""; 
          }else if($('#admin').val() == 2){
            spanC="<form action='./php/bo/deleteProduct.php' method='post'><input type=hidden name='id_article' value =" +donnees[i].id+"><button class='btn btn-danger close '>\u00D7</button></form>"; 
          }          $(".results").append('<div class="col-5 article">'+spanC+'<a href=articles.php?art='+donnees[i].id +'><img class="picture"src= "'+ donnees[i].url +'" width=60%><div class="description">Prix: '+ donnees[i].prix +'€</div><div class="description">Nom: '+donnees[i].nom_article+'</div></div></div></div>');
        }
      }else if (form == "checkbox"){
        for(let i=0;i<donnees.length;i++){   
        $('.whole_form').append('<p><label for="type" class="text-white">' +donnees[i].nom+'</label><input type="checkbox" id='+donnees[i].nom+' name="filtre"></p>');
        }
        $(":checkbox").on('click',only_one);
      }
      })
    .fail(function(jqXHR, textStatus, err){
    });
  }

  ajax_call("checkbox","http://localhost:3000/articles/type/" + centre);
  ajax_call("article","http://localhost:3000/articles/up/" +centre);
  ajax_call("carousel","http://localhost:3000/articles/carousel/" +centre);

  function only_one(){
    $(".results").empty();
    let $wt, $block,i=0, url;
    // Put the selected checkbox in $box
    let $box = $(this);
    // Select the checked box
    if ($box.is(":checked")) {
      let group = "input:checkbox[name='" + $box.attr("name") + "']";
      // Desactivate all the other checkbox 
      $(group).prop("checked", false);
      // Activate $box
      $box.prop("checked", true);
    }else{
      // Desactivate $box if not clicked on 
      $box.prop("checked", false);
    }
      //Adapting the url for the ajax request
    if($box.attr("id") == "up" || $box.attr("id") == "down"){

      url = 'http://localhost:3000/articles/' + $box.attr("id")+'/'+centre;
    }else{
      url = 'http://localhost:3000/articles/type/' + $box.attr("id")+'/'+centre;
    }   
    ajax_call("article",url);
  }

  // Adding listener on the basket
  $("#panier").on('click', function(){
    ajax_call("carousel","http://localhost:3000/articles/carousel");
    // Redirecting the user
    window.location.href = "http://localhost/web_project/panier.php";
  });

})

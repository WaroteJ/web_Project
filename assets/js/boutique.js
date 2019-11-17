$(function(){
  let centre = $('#centre').val();
  function ajax_call(form,url){
    $.ajax({
      type:'GET',
      url: url ,
      dataType:'json'
    })
    .done(function(data){
      let donnees = typeof data !='object' ? JSON.parse(data) : data;   
      if(form == "carousel"){
        console.log("adding carousel pic");
        for(let i=0;i<donnees.length;i++){
          console.log("adding carousel pic");

          $(".carousel-inner").append('<div class="carousel-item "><img src="' +donnees[i].url+'" class="d-block w-50 mx-auto" alt=top'+i+'></div>');
        }
        console.log("adding carousel pic");
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
        console.log("adding articles");
      }else if (form == "checkbox"){
        for(let i=0;i<donnees.length;i++){   
        $('.whole_form').append('<p><label for="type" class="text-white">' +donnees[i].nom+'</label><input type="checkbox" id='+donnees[i].nom+' name="filtre"></p>');
        }
        $(":checkbox").on('click',only_one);
      }
      console.log("adding type buttons");
      })
    .fail(function(jqXHR, textStatus, err){
      console.log('AJAX error response:', textStatus);
    });
  }

  ajax_call("checkbox","http://localhost:3000/articles/type/" + centre);
  ajax_call("article","http://localhost:3000/articles/up/" +centre);
  ajax_call("carousel","http://localhost:3000/articles/carousel" +centre);



  function only_one(){
    $(".results").empty();
    let $wt, $block,i=0, url;
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
    }else{
      $box.prop("checked", false);
    }

    if($box.attr("id") == "up" || $box.attr("id") == "down"){
      url = 'http://localhost:3000/articles/' + $box.attr("id")+'/'+centre;
    }else{
      url = 'http://localhost:3000/articles/type/' + $box.attr("id")+'/'+centre;
    }   
    ajax_call("article",url);
  }


  $("#panier").on('click', function(){
  ajax_call("carousel","http://localhost:3000/articles/carousel");
  window.location.href = "http://localhost/web_project/panier.php";
  });

})

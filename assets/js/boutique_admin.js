$(function(){
    $.ajax({
      type:'GET',
      url: 'http://localhost:3000/articles/up',
      dataType:'json'
    })
    .done(function(data){
      let donnees = typeof data !='object' ? JSON.parse(data) : data;
      for(let i=0;i<donnees.length;i++){
        let spanC="<form action='./php/bo/deleteProduct.php' method='post'><input type=hidden name='id_article' value =" +donnees[i].id+"><button class='btn btn-danger close '>\u00D7</button></form>";

      $(".results").append('<div class="col-5 article">'+spanC+'<a href=articles.php?art='+donnees[i].id +'><img class="picture"src= "'+ donnees[i].url +'" width=60%><div class="description">Prix: '+ donnees[i].prix +'€</div><div class="description">Nom: '+donnees[i].nom_article+'</div>'+spanC+'</div></div></div>');
 
    }       
    })
    .fail(function(jqXHR, textStatus, err){
      console.log('AJAX error response:', textStatus);
      });

      $(".close").on('click', function(){
        let parent = this.parentElement;
        parent.style.display = "none";
    })

    $.ajax({
      type:'GET',
      url: 'http://localhost:3000/articles/carousel',
      dataType:'json'
    })
    .done(function(data){
    let donnees = typeof data !='object' ? JSON.parse(data) : data;
    for(let i=0;i<donnees.length;i++){
      $(".carousel-inner").append('<div class="carousel-item "><img src="' +donnees[i].url+'" class="d-block w-50 mx-auto" alt=top'+i+'></div>');
    }
    $(".carousel-inner :nth-child(1)").addClass("active");              
    })
    .fail(function(jqXHR, textStatus, err){
      console.log('AJAX error response:', textStatus);
    });

    $.ajax({
      type:'GET',
      url: 'http://localhost:3000/articles/type',
      dataType:'json'
    })
    .done(function(data){
      let donnees = typeof data !='object' ? JSON.parse(data) : data;
      for(let i=0;i<donnees.length;i++){
        $('.whole_form').append('<p><label for="type" class="text-white">' +donnees[i].nom+'</label><input type="checkbox" id='+donnees[i].nom+' name="filtre"></p>');
      }
      $(":checkbox").on('click', function() {
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
        } else {
        $box.prop("checked", false);
        }

      if($box.attr("id") == "up" || $box.attr("id") == "down"){
        url = 'http://localhost:3000/articles/' + $box.attr("id");
      }else {
        url = 'http://localhost:3000/articles/type/' + $box.attr("id");
      }   
      $.ajax({
        type:'GET',
        url: url ,
        dataType:'json'
      })
      .done(function(data){
        let donnees = typeof data !='object' ? JSON.parse(data) : data;
        let spanC="<form action='./php/bo/deleteProduct.php' method='post'><input type=hidden name='id_article' value =" +donnees[i].id+"><button class='btn btn-danger close '>\u00D7</button></form>";
        for(let i=0;i<donnees.length;i++){    
          $(".results").append('<div class="col-5 article">'+spanC+'<a href=articles.php?art='+donnees[i].id +'><img class="picture"src= "'+ donnees[i].url +'" width=60%><div class="description">Prix: '+ donnees[i].prix +'€</div><div class="description">Nom: '+donnees[i].nom_article+'</div></div></div></div>');
        }
        })
      .fail(function(jqXHR, textStatus, err){
        console.log('AJAX error response:', textStatus);
      });
      })
    })
    .fail(function(jqXHR, textStatus, err){
        console.log('AJAX error response:', textStatus);
    });
  
  // $(":checkbox").on('click', function() {
  //   alert ("deuxième");
  //    $(".results").empty();
  //   let $wt, $block,i=0,url;
  //   // in the handler, 'this' refers to the box clicked on
  //   let $box = $(this);
  //   //console.log($box.attr("id"));
  //   if ($box.is(":checked")) {
  //   // as it is assumed and expected to be immutable
  //     let group = "input:checkbox[name='" + $box.attr("name") + "']";
  //   // the checked state of the group/box on the other hand will change
  //   // and the current value is retrieved using .prop() method
  //     $(group).prop("checked", false);
  //     $box.prop("checked", true);
  //   } else {
  //     $box.prop("checked", false);
  //   }
  //   if($box.attr("id") == "up" || $box.attr("id") == "down"){
  //      url = 'http://localhost:3000/articles/' + $box.attr("id");
  //   }else {
  //      url = 'http://localhost:3000/articles/type/' + $box.attr("id");
  //      alert($box.attr("id"));
  //   }
  //   $.ajax({
  //   type:'GET',
  //   url: url ,
  //   dataType:'json'
  //   })
  //   .done(function(data){
  
  //     let donnees = typeof data !='object' ? JSON.parse(data) : data;
  //     let spanC="<form action='./php/bo/deleteProduct.php' method='post'><input type=hidden name='id_article' value =" +donnees[i].id+"><button class='btn btn-danger close '>\u00D7</button></form>";
  //     for(let i=0;i<donnees.length;i++){    
  //       $(".results").append('<div class="col-5 article">'+spanC+'<a href=articles.php?art='+donnees[i].id +'><img class="picture"src= "'+ donnees[i].url +'" width=60%><div class="description">Prix: '+ donnees[i].prix +'€</div><div class="description">Nom: '+donnees[i].nom_article+'</div></div></div></div>');
  //     }
  //   })
  //   .fail(function(jqXHR, textStatus, err){
  //       console.log('AJAX error response:', textStatus);
  //     });
  // });
  
  
  
  $("#panier").on('click', function() {
    window.location.href = "http://localhost/web_project/panier.php";
  })

});

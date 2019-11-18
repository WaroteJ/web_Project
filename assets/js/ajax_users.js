$(document).ready(function() {
    let debut = 0;
    let pas = 2;

    let url  = 'http://localhost:3000/users/' + $('#centre').val();

    // Ajax request
    function ajax_call(form,url){
    $.ajax({
      type:'GET',
      url: url ,
      dataType:'json'
    })
    .done(function(data){
        let donnees = typeof data !='object' ? JSON.parse(data) : data;
        let table = $('<table/>');
        table.addClass('user_table');
        var $headerTr = $('<tr/>');


        // Put the <th/> (title) of each column
        for (var index in donnees[0]) {
            $headerTr.append($('<th/>').html(index));
          }
        table.append($headerTr);
        // Creating the <tr/> (lign) for each person
        for (var i = 0; i < donnees.length; i++) {
            var $tableTr = $('<tr/>');
            for (var index in donnees[i]) {
                $tableTr.append($('<td/>').html(donnees[i][index]));
            }
        table.append($tableTr);
        }
        // let div_next = $('<div/>');
        let next = $('<button/>',
        {
            text: 'Next',id: 'next',name: 'next'
        });
        // let div_previous = $('<div/>');
        let previous = $('<button/>',
        {
            text: 'Previous', id: 'previous', name: 'previous'
        });
        

        $('button').remove();
        $('table').remove();
        $('#listing').remove();
        $('main').append(table);

        $('#button').prepend(table);

        $('.next').append(next);
        $('.previous').append(previous);
    })
    .fail(function(jqXHR, textStatus, err){
    });
    }
    // Listener pagination button
    $('.next').on("click",function(){
        debut = debut +2;
        ajax_call("",url +"/"+debut+"/"+2);
    });
    // Listener pagination button
    $('.previous').on("click",function(){
        if (debut <= 0 ){
            debut = debut;
        }else {
            debut = debut -2;
        }
        ajax_call("",url +"/"+debut+"/"+pas);
    });

    $("#list_user").on("click", function() {      
        ajax_call("",url +"/"+debut+"/"+pas);
    });
});

    


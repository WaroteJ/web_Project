$(document).ready(function() {
    $("#list_commandes").on("click", function() {
            
        let url  = 'http://localhost:3000/commandes/' /*+ $('#admin').val();*/
    
        $.ajax({
            type:'GET',
            url: url,
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
                //if(donnees[i].id != donnees[i-1].id){
                    var $tableTr = $('<tr/>');
                //}
                for (var index in donnees[i]) {
                    $tableTr.append($('<td/>').html(donnees[i][index]));
                 }
            // console.log(donnees[i].nom);
            table.append($tableTr);
                }
            $('#listing').remove();
            $('table').remove();
            $('main').append(table);
        })
        .fail(function(jqXHR, textStatus, err){
            console.log('AJAX error response:', textStatus);
        });
    });
});
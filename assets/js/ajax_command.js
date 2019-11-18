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
            let input;
    
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
                    if(donnees[i][index] ==  donnees[i].date){
                    let first_date = donnees[i][index].split("-",3);
                    let snd_date = first_date[2].split("T",1);
                    let final_date = first_date[0] + "-"+ first_date[1] +"-"+ snd_date;

                    input = first_date[0] + "-"+ first_date[1] +"-"+ snd_date;

                    }else {
                        input = donnees[i][index];
                    }
                    $tableTr.append($('<td/>').html(input));
                 }
            // console.log(donnees[i].nom);
            table.append($tableTr);
                }
            $('#listing').remove();
            $('table').remove();
            $('main').append(table);
            $('button').remove();
        })
        .fail(function(jqXHR, textStatus, err){
            console.log('AJAX error response:', textStatus);
        });
    });
});
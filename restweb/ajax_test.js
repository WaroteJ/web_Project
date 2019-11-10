function get(){
    $.ajax({
        type:'GET',
        url:'http://localhost:3000/users',
        dataType:'json'
    })
    .done(function(data){
        let donnees = typeof data !='object' ? JSON.parse(data) : data;
        var $table = $('<table/>');
        var $headerTr = $('<tr/>');

        // Put the <th/> (title) of each column
        for (var index in donnees[0]) {
            $headerTr.append($('<th/>').html(index));
            console.log ("Ajout du nom de la colonne: " +  [index]);
          }
        $table.append($headerTr);
        // Creating the <tr/> (lign) for each person
        for (var i = 0; i < donnees.length; i++) {
            var $tableTr = $('<tr/>');
            console.log ("Ajout de la ligne n°: " + [i] );
            for (var index in donnees[i]) {
                $tableTr.append($('<td/>').html(donnees[i][index]));
                console.log ("Ajout de la donnees: " + [index]+": "+donnees[i][index] );
            }
        $table.append($tableTr);
        }
        $('body').append($table);
    })
    .fail(function(jqXHR, textStatus, err){
        console.log('AJAX error response:', textStatus);
    });
}
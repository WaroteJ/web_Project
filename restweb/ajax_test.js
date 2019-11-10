function get(){
    $.ajax({
        type:'GET',
        url:'http://localhost:3000/users',
        dataType:'json'
    })
    .done(function(data){
        let donnees = JSON.stringify(data,"",2);
        let users = JSON.parse(donnees);
        let table =$("<table></table");
        
        alert (Object.keys(donnees).length); // returns 5
        let content;
        while (lign in donnees){
            let row = $("tr")
        }
        $('#getResponse').html(donnees);
    })
    .fail(function(jqXHR, textStatus, err){
        console.log('AJAX error response:', textStatus);
    });
}
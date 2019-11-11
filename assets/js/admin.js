$(function(){
    $('#payant').click(function(){ // Toggle l'input prix en fonction de la checkbox payant
            $('#prix').toggle();
    });

    date.min = new Date().toISOString().split("T")[0]; // Set the minimum date to today
});
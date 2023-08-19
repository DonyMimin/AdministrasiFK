$(document).ready(function(){

    $('#tombol-cari').hide();

    // event input keyword
    $('#keyword').on('keyup', function(){
        //loader
        $('#loader').show();

        // $('#container').load('ajax/searchPTA.php?keyword='+ $('#keyword').val());

        $.get('ajax/searchPTA.php?keyword=' + $('#keyword').val(), function(data){

            $('#container').html(data);
            $('#loader').hide();

        });
        
    });

});

let odabraniPolaznik=null;

     $( '#uvjet' ).autocomplete({
        source: function(req,res){
           $.ajax({
               url: url + 'polaznik/trazi?term=' + req.term + 
                    '&grupa=' + grupa,
               success:function(odgovor){
                   res(JSON.parse(odgovor));
                //console.log(odgovor);
            }
           }); 
        },
        minLength: 2,
        select:function(dogadaj,ui){
            //console.log(ui.item);
            //spremi(ui.item);
            odabraniPolaznik = ui.item;
            $("#napomenaModal").foundation("open");
            setTimeout(() => {
                $('#napomena').focus();
            }, 50);
           
            

        }
    }).autocomplete( 'instance' )._renderItem = function( ul, item ) {
        return $( '<li>' )
          .append( '<div>' + item.ime + ' ' + item.prezime + '<div>')
          .appendTo( ul );
      };

function spremi(polaznik){
    $.ajax({
        url: url + 'grupa/dodajpolaznik?grupa=' + grupa + 
             '&polaznik=' + polaznik.sifra + '&napomena=' + 
             polaznik.napomena,
        success:function(odgovor){
           $('#podaci').append(
            '<tr>' + 
                '<td>' +
                    polaznik.prezime + ' ' + polaznik.ime +
                '</td>' + 
                '<td>' +
                    polaznik.napomena +
                '</td>' + 
                '<td>' +
                    '<a class="brisiPolaznika" href="#" id="p_' + polaznik.sifra +  '">' +
                    ' <i style="color: red;" ' +
                    ' class="step fi-page-delete size-36"></i>' +
                    '</a>' +
                '</td>' + 
            '</tr>'
           );
           $("#napomenaModal").foundation("close");
           $('#napomena').val('');
           definirajBrisanje();
     }
    }); 
}

function definirajBrisanje(){
    $('.brisiPolaznika').click(function(){
        let a =  $(this);
        let polaznik = a.attr('id').split('_')[1];
        $.ajax({
            url: url + 'grupa/obrisipolaznik?grupa=' + grupa + 
                '&polaznik=' + polaznik,
            success:function(odgovor){
            a.parent().parent().remove();
        }
        }); 

        return false;
    });
}

definirajBrisanje();
$('#naziv').focus();

$('#napomenaOdustani').click(function(){
    $("#napomenaModal").foundation("close");
    $('#uvjet').focus();
    return false;
});

$('#napomenaSpremi').click(function(){

    odabraniPolaznik.napomena = $('#napomena').val();
    spremi(odabraniPolaznik);

    return false;
});
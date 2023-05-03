
var sifraPolaznik;

$(".slika").click(function(){
    sifraPolaznik=$(this).attr("id").split("_")[1];
      $("#image").attr("src",$(this).attr("src"));
      $("#slikaModal").foundation("open");
      definirajCropper();

      return false;
  });

  $("#spremi").click(function(){
    var opcije = { "width": 350, "height": 350 };
    var result = $image.cropper("getCroppedCanvas", opcije, opcije);
    
    $.ajax({
        type: "POST",
        url:  url + "/polaznik/spremisliku",
        data: "id=" + sifraPolaznik + "&slika=" + result.toDataURL(),
        success: function(vratioServer){
          if(vratioServer==="OK"){
            $("#p_"+sifraPolaznik).attr("src",result.toDataURL());
            $("#slikaModal").foundation("close");
          }else{
            alert(vratioServer);
          }
        }
      });


    return false;
  });



  var $image;

  function definirajCropper(){


    var URL = window.URL || window.webkitURL;
    $image = $('#image');
    var options = {aspectRatio: 1 / 1 };
    
    // Cropper
    $image.on({}).cropper(options);
    
    var uploadedImageURL;
    
    
    // Import image
    var $inputImage = $('#inputImage');
    
    if (URL) {
      $inputImage.change(function () {
        var files = this.files;
        var file;
    
        if (!$image.data('cropper')) {
          return;
        }
    
        if (files && files.length) {
          file = files[0];
    
          if (/^image\/\w+$/.test(file.type)) {
           
    
            if (uploadedImageURL) {
              URL.revokeObjectURL(uploadedImageURL);
            }
    
            uploadedImageURL = URL.createObjectURL(file);
            $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
            $inputImage.val('');
          } else {
            window.alert('Datoteka nije u formatu slike');
          }
        }
      });
    } else {
      $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
    
    }

let brisem;

$('.brisanjePolaznika').click(function(){
  brisem=$(this).attr('href');
  let id = $(this).attr('id').split('_')[1];
  console.log(url);
  $.get(url + 'polaznik/mozebrisati/' + id, function( data ) {
    if(data=='NE'){
      alert('Polaznik se ne može obrisati jer je na jednoj ili više grupa');
    }else{
      $('#stoSeBrise').attr('src',$('#p_' + id).attr('src'));
      $("#brisiModal").foundation("open");
    }

    return false;
  });

  

  return false;
});

$('#obrisi').click(function(){
  console.log('Brišem: ' + brisem);
  window.location.href = brisem;

  return false;
});
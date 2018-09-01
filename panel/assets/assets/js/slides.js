
$(function($){
  $("input[name='img_url']").on("change", function(){
    var image = document.getElementById("image")
    var files = $(this)[0].files
    var file  = files[0]
    $("#image").attr("src", window.URL.createObjectURL(file))

    var cropper = new Cropper(image, {
      aspectRatio: 16 / 9
    }) 
    cropper.crop()
    cropper.getCropperCanvas().toBlob(funvtion(blob){

      var formData = new FormData();
      formData.append("croppedImage", blob)
      $.ajax({
        type:"POST",
        url: $(this).data("url");,
        data:formData,
        processData: false,
        contentType: false,
        success:function(data){

        },
        error: function(err){

        }

      })
    })



  })


})



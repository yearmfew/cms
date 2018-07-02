$(document).ready(function () {



	$(".sortable").sortable();

	 /*remove-btn : bunu bir sınıf olarak butonumuza ekliyoruz. 
    bu sınıfın eklendiği butona tıklanınca aşağıdaki kodlar çalışıyor. 
    burada data_url ile butonun gideceği yerde dinamik oldu. 
    uyarı vermek için sadece bu sınıfı eklemek yeterli olacak.*/

    $(".content-container, .image_list_container").on('click', '.remove-btn', function () {


    	var $data_url = $(this).data("url");
	/*burada kullanılan data fonksiyonu a href içinde de kullanılıyor. bu fonksiyon href içindeki data- den sonra 
	hangi değişkeni verdi isek gidip onun içindeki dveriyi alıyor.*/

	swal({
		title: 'Emin misiniz?',
		text: "Bu işlemi geri alamayacaksınız!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Evet, Sil!',
		cancelButtonText : "Hayır"
	}).then(function (result) {
        	// evete tıklanmış ise aşağıdaki kodları çalıştır. yani data_url ye git.
        	if (result.value) {

        		window.location.href = $data_url;
        	}
        });
})
	/*
	burada gönderme işlemini bu metod yapıyor. data_url değişkeninde ki linke aldığımız
	data yani checked değerini yoluyoruz
	ve sayfayı yenilemeden o metodu çalıştırmış oluyoruz.*/

	$(".content-container, .image_list_container").on('change', '.isActive', function(){

		var $data = $(this).prop("checked");
		var $data_url = $(this).data("url");

		if(typeof $data !== "undefined" && typeof $data_url !== "undefined"){

			$.post($data_url, { data : $data}, function (response) {

			});

		}

	})


	$(".image_list_container").on('change', '.isCover',  function(){

		var $data 		= $(this).prop("checked");
		var $data_url 	= $(this).data("url");

		if(typeof $data !== "undefined" && typeof $data_url !== "undefined"){

			$.post($data_url, { data : $data}, function (response) {

				$(".image_list_container").html(response);

				$('[data-switchery]').each(function(){
					var $this = $(this),
					color = $this.attr('data-color') || '#188ae2',
					jackColor = $this.attr('data-jackColor') || '#ffffff',
					size = $this.attr('data-size') || 'default'

					new Switchery(this, {
						color: color,
						size: size,
						jackColor: jackColor
					});
				});
				$(".sortable").sortable();

			});

		}
	})

	// sortable ile değişiklik yaptığımızda değişikliği algılayan fonksiyon

 $(".content-container, .image_list_container").on("sortupdate", '.sortable',  function(event, ui){

		var $data = $(this).sortable("serialize");
		var $data_url = $(this).data("url");

		$.post($data_url, {data : $data}, function(response){})

	})


	var uploadSection = Dropzone.forElement("#dropzone");

	uploadSection.on("complete", function(file){

		var $data_url = $("#dropzone").data("url");

		$.post($data_url, {}, function(response){

			$(".image_list_container").html(response);
// image_list_container adlı sınıfı kullandığın yere dropzone dan gelen veriyi yolla.
$('[data-switchery]').each(function(){
	var $this = $(this),
	color = $this.attr('data-color') || '#188ae2',
	jackColor = $this.attr('data-jackColor') || '#ffffff',
	size = $this.attr('data-size') || 'default'

	new Switchery(this, {
		color: color,
		size: size,
		jackColor: jackColor
	});
});
$(".sortable").sortable();


});

	})



})



$(document).ready(function () {

    $(".remove-btn").click(function (e) {

        var $data_url = $(this).data("url");

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
            if (result.value) {

                window.location.href = $data_url;
            }
        });


    })

})


// burada kullanılan data fonksiyonu a href içinde de kullanılıyor. bu fonksiyon href içindeki data- den sonra 
// hangi değişkeni verdi isek gidip onun içindeki dveriyi alıyor.

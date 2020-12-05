
$("#tablaArticulos").DataTable({
    "processing": true,
    "serverSide": true,
    "sAjaxSource": "ServerSide/serversideUsuarios.php",
    "columnDefs": [{
        "data": null,
        "targets": -1,
        "render": function (data, type, row, meta) {
            return "<div class='wrapper text-center'><div class='btn-group'><button class='buttonVerde mr-2 btnEditar' title='Editar'><i class='fas fa-camera'></i></button><button class='buttonRojo btnBorrar' title='Eliminar'><i class='fas fa-eraser'></i></button></div></div>";
        }
    }],
    "fixedColumns": true,
    "language": {
        "url": "./DataTables/Spanish.json"
    }
});


const modal = document.querySelector('.modal');
const closeModal = document.querySelectorAll('.close-modal');

//Editar        
$(document).on("click", ".btnEditar", function () {
    fila = $(this).closest("tr")
    let idart = parseInt(fila.find('td:eq(0)').text())
    codigo = fila.find('td:eq(1)').text()
    articulo = fila.find('td:eq(2)').text()
    $("#idart").val(idart)
    $("#image").val('')
    $("#mod_articulo").text(codigo + '(' + articulo + ')');
    $.ajax({
        method: 'GET',
        url: 'busca_idart.php',
        data: { idart: idart },
        dataType: 'json',
        success: function (data) {
            $(".card-img-top").attr("src", data.foto);
        }
    });
    modal.classList.remove('hidden')
    modal.classList.add('flex')
})

closeModal.forEach(close => {
    close.addEventListener('click', function () {
        modal.classList.add('hidden')
        modal.classList.remove('flex')
    })
});

//foto
$(".upload").on('click', function () {
    let idart = $('#idart').val();
    const el = document.getElementById("img");
    let formData = new FormData();
    let files = $('#image')[0].files[0];
    formData.append('file', files);
    formData.append('idart', idart);
    $.ajax({
        url: 'upload.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            //alert(response);
            if (response != 0) {
                el.src = response;
            } else {
                alert('Se permiten archivos .gif, .jpg, .png. y de 500 kb como máximo.');
            }
        }
    });
    return false;
});
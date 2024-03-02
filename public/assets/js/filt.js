$('#centro').change(function (e) {
    e.preventDefault();




    filtrar()


});


function filtrar() {
    var centro = $('#centro').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "POST",
        url: "/filtrar",
        data: {
            centro: centro

        }

    })
        .done(function (data) {
            console.log(data);
            $('#filtrar').empty();
            $('#filtrar').html(data);

        })
        .fail(function (jqXHR, a) {


            console.log(jqXHR)
        })


}


function sumar(alcalde, bandera, ambos, total) {

    var suma = parseInt($(alcalde).val()) + parseInt($(bandera).val()) + parseInt($(ambos).val());

    $(total).empty();
    $(total).val(suma);

}


$(document).ready(function () {
    $('.soloNumeros').on('input', function () {
        var numero = $(this).val();
        if (!/^[\d]*$/.test(numero)) {
            // Si el valor no es un número, eliminar el último carácter ingresado
            $(this).val(numero.slice(0, -1));
            // Opcional: Mostrar un mensaje de error
            //alert("Solo se permiten números");
        }
    });
});
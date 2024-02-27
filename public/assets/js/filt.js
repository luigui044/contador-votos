$('#centro').change(function(e) {
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
        .done(function(data) {
            console.log(data);
            $('#filtrar').empty();
            $('#filtrar').html(data);

        })
        .fail(function(jqXHR, a) {


            console.log(jqXHR)
        })


}


function sumar(alcalde, bandera, ambos, total) {

    var suma = parseInt($(alcalde).val()) + parseInt($(bandera).val()) + parseInt($(ambos).val());

    $(total).empty();
    $(total).val(suma);

}
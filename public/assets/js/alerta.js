$('#guardar').confirm({
    title: 'Confirmar',
    content: 'Desea guardar los datos de la Junta Receptora de Votos' + $('#jrv').val(),
    buttons: {
        confirmar: {
            btnClass: 'btn-success',
            function() {


                $("#formulario").submit();
            },

        },

        cancelar: {
            btnClass: 'btn-danger',
            function() {
                $.alert('Cancelado')
            }
        }

    }
});
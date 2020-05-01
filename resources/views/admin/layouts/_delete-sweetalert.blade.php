<script>
    $('body').on('click', '.js-sweetalert', function () {
        let url = $(this).data('url');
        let type = $(this).data('type');
        if (type === 'delete') {
            showDeleteMessage(url);
        }
    });

    function showDeleteMessage(url) {
        swal({
            title: "¿Estás seguro?",
            text: "¡No podrás recuperar este registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Si, Eliminar",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true,
        }, function (isConfirm) {
            if (isConfirm) {
                setTimeout(function () {
                    eliminar(url);
                }, 1000);
            }
        });
    }

    function eliminar(url) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: url,
            success: (result) => {
                if (result.isDeleted) {
                    swal({
                        title: "Eliminado!",
                        text: "El registro ha sido eliminado",
                        type: "success"
                    }, () => {
                        window.location.reload(true);
                    });
                } else {
                    swal({
                        title: "Cancelado!",
                        text: "No se puede eliminar. Esta asociado aun registro",
                        type: "error"
                    });
                }
            }
        });
    }
</script>
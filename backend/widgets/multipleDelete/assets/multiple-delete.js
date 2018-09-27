var MultipleDelete = function () {

    return {
        //main function to initiate the module
        init: function () {
            $('button.multiple-delete').click(function (e) {
                $el = $(this);
                var gridId = $el.data('gridid');
                if (gridId) {
                    var ids = $('#' + gridId).yiiGridView('getSelectedRows');
                    if (ids.length > 0) {
                        var confirm = $el.data('deleteconfirm');
                        var url = $el.data('url');
                        swal({
                                title: confirm,
                                text: '',
                                type: 'error',
                                allowOutsideClick: true,
                                showConfirmButton: true,
                                showCancelButton: true,
                                confirmButtonClass: 'btn-danger',
                                cancelButtonClass: 'btn-success',
                                confirmButtonText: 'Да',
                                cancelButtonText: 'Нет'
                            },
                            function () {
                                var form = $('<form action=' + url + ' method=\"POST\"></form>'),
                                    csrfParam = $('meta[name=csrf-param]').prop('content'),
                                    csrfToken = $('meta[name=csrf-token]').prop('content');

                                if (csrfParam) {
                                    form.append('<input type=\"hidden\" name=' + csrfParam + ' value=' + csrfToken + ' />');
                                }
                                $.each(ids, function (index, id) {
                                    form.append('<input type=\"hidden\" name=\"ids[]\" value=' + id + ' />');
                                });
                                form.hide().appendTo('body');
                                form.submit();
                            });
                    }
                }
            });
        }
    }
}();

jQuery(document).ready(function () {
    MultipleDelete.init();
});

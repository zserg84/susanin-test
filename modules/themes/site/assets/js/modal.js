$(function(){
    $(document).on("click", ".modal-call", function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            error: function (xhr, status, error) {
                alert('error');
            },
            success: function (result, status, xhr) {
                $("#modal-popup .modal-body").html(result);
                $("#modal-popup").modal();
            }
        });
        return false;
    });
});
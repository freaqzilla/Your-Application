$('document').ready(function () {
    $(".delete_button").click(function ()
    {
        var delete_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "user/delete",
            data: {id: delete_id},
            dataType: "text",
            success: function (data) {
                if (data == 1) {
                    alert('User deleted');
                    location.reload();
                } else {
                    alert('User could not be deleted');
                }
            }
        });
        
        return false;
    });

    $(".save_edited_button").click(function ()
    {
        var edit_id = $(this).val();
        var form = $('.users_form_' + edit_id);
        $.ajax({
            type: "POST",
            url: "user/edit",
            data: form.serializeArray(),
            success: function (data) {
                if (data == 1) {
                    alert('User details updated');
                    location.reload();
                } else {
                    $('#errors_' + edit_id).html(data);
                }
            }
        });
        
        return false;
    });

    $(".save_button").click(function ()
    {
        var form = $('.add_users_form');
        $.ajax({
            type: "POST",
            url: "user/add",
            data: form.serializeArray(),
            success: function (data) {
                if (data > 0) {
                    alert('User inserted');
                    location.reload();
                } else {
                    $('#errors_add').html(data);
                }
            }
        });
        
        return false;
    });

    $("#add_button").click(function () {
        $('.addUser').show();
    });
});
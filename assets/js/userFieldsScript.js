$('document').ready(function () {
    $(".delete_button").click(function ()
    {
        var delete_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "field/delete",
            data: {id: delete_id},
            dataType: "text",
            success: function (data) {
                if (data == 1) {
                    alert('Field deleted');
                    location.reload();
                } else {
                    alert('Field could not be deleted');
                }
            }
        });
        return false;
    });

    $(".save_button").click(function ()
    {
        var form = $('.add_fields_form');
        $.ajax({
            type: "POST",
            url: "field/add",
            data: form.serialize(),
            success: function (data) {
                if (data == 1) {
                    alert('Field inserted');
                    location.reload();
                } else {
                    alert('Field could not be inserted');
                }
            }
        });
        return false;
    });

    $(".fields_form").submit(function()
    {
        var formURL = $(this).attr("action");
        var form = $(this);
        $.ajax({
            url: formURL,
            type: "POST",
            data: form.serialize(),
            success: function (data)
            {
                if (data == 1) {
                    alert('Fields updated');
                    location.reload();
                } else {
                    alert('Fields could not be updated');
                }
            }
        });
        return false;
    });

    $("#add_button").click(function() {
        $('.addField').show();
    });

});
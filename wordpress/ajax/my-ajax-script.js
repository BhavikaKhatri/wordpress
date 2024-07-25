jQuery(document).ready(function ($) {
    $('#my-form').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'my_action',
                data: formData
            },
            success: function (response) {
                $('#result').html(response);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
});

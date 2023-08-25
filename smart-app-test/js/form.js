jQuery(document).ready(function ($) {
    $("form").submit(function (event) {

        const email = document.getElementById("custom-form-email").value;
        const reg = /^[.\-\+\w]+@[a-zA-Z_]+\.[a-zA-Z]{2,}$/;
        const result = reg.test(email);

        const firstName = $('#custom_form_first_name').val()
        const lastName = $('#custom_form_last_name').val()
        const subject = $('#custom_form_subject').val()
        const message = $('#custom_form_message').val()

        if (result === false) {
            console.log(email);
            alert("Invalid email");

            return false;
        }

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'email_send', // Action hook name
                firstName: firstName,
                lastName: lastName,
                email: email,
                subject: subject,
                message: message
            },
            beforeSend: function() {
                $('#smart-app-custom-form-container .smart-app-custom-form').html('<div class="loading"><svg><use xlink:href="#loading"></use></svg></div>');
            },
            success: function(response) {

                if(response.status === 'success'){
                    $('#smart-app-custom-form-container .smart-app-custom-form').html('<div class="message success">Your message was successfully send<div>');
                }else if(response.status === 'error'){
                    console.log('Error');
                }else {
                    console.log('Something went wrong');
                }

            },
            error: function(xhr, status, error) {
                console.log('An error occurred while sending the request');
            }
        });
        window.onbeforeunload = null;
        event.preventDefault();
        return true;
    });
});

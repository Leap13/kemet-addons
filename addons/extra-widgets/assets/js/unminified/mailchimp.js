(function ($) {

    "use strict";

    var valid = "invalid";
    function validateValue($value, $target, $placeholder, $email) {
        if ($email == true) {
            var n = $value.indexOf("@");
            var r = $value.lastIndexOf(".");
            if (n < 1 || r < n + 2 || r + 2 >= $value.length) {
                valid = "invalid";
            } else {
                valid = "valid";
            }

            if ($value == null || $value == "" || valid == "invalid") {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }

        } else {
            if ($value == null || $value == "" || $value == $placeholder) {
                $target.addClass('visible');
            } else {
                $target.removeClass('visible');
            }
        }
    };

    $('.et-mailchimp-form').each(function () {

        var $this = $(this);

        $this.submit(function (event) {

            // 1. Prevent form submit default

            event.preventDefault();

            // 2. serialize form data

            var formData = $this.serialize();

            var email = $this.find("input[name='email']"),
                fname = $this.find("input[name='fname']"),
                lname = $this.find("input[name='lname']"),
                list = $this.find("input[name='mailchimp_list_id']");

            // 3. Before submit validate email

            validateValue(email.val(), email.next(".alert"), email.attr('data-placeholder'), true);

            if (email.val() != email.attr('data-placeholder') && valid == "valid") {

                $this.find(".sending").addClass('visible');

                // 4. POST AJAX

                $.ajax({
                    type: 'POST',
                    url: "' . admin_url('admin-ajax.php') . '",
                    data: formData
                })
                    .done(function (response) {

                        // 5. If success show the success message to user

                        $this.find(".sending").removeClass('visible');
                        $this.find(".et-mailchimp-success").addClass('visible');
                        setTimeout(function () {
                            $this.find(".et-mailchimp-success").removeClass('visible');
                        }, 2000);
                    })
                    .fail(function (data) {

                        // 6. If fail show the error message to user

                        $this.find(".sending").removeClass('visible');
                        $this.find(".et-mailchimp-error").addClass('visible');
                        setTimeout(function () {
                            $this.find(".et-mailchimp-error").removeClass('visible');
                        }, 2000);
                    })
                    .always(function () {

                        // 7. Clear the form fields for next subscibe request

                        setTimeout(function () {
                            $this.find("input[name='email']").val(email.attr('data-placeholder'));
                            $this.find("input[name='fname']").val(fname.attr('data-placeholder'));
                            $this.find("input[name='lname']").val(lname.attr('data-placeholder'));
                        }, 2000);
                    });

            }
        });
    });

})(jQuery);
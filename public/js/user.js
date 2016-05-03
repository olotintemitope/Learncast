(function ($) {
    $.fn.userPlugin = function() {
        return $(this).each(function() {
            user = new User()
            user.signUp()
        });
    }

    function User() {

        this.makeAjaxRequest  = function(url, parameters, request) {
            return $.ajax({
                url:url,
                data:parameters,
                type: request == '' ? 'GET' : 'POST',
                beforeSend:function() {
                },
                error:function() {
                }
            });
        }

        this.signUp = function() {
            signUpBtn = $("#signup")
            formWrapper = $("#signUpForm")
            reporter = $(".info")
            $(".preloader-wrapper").hide();
            user = new User()
            var error = 0

            signUpBtn.on("click", function() {
                formFields = formWrapper.find("input")

                    $.each(formFields, function(key, val) {
                        if ($(this).val() == '') {
                            $("#"+$(this).attr('id')).addClass('error')
                            error++
                        } else {
                            $("#"+$(this).attr('id')).addClass('noerror')
                        }
                    });
                    if (error <= 0) {
                        $(".preloader-wrapper").show();
                        user.makeAjaxRequest('auth/register', formFields, 'POST')
                        .done(function(response) {
                            $(".preloader-wrapper").hide();
                            if (response.statuscode === 200) {
                                reporter.html(response.message).css('color', 'green')
                                window.location.href = '/'
                            }
                            reporter.html(response.message).css('color', 'red')

                        });
                    } else {
                        reporter.html("Fill the fields highlighted in reds").css('color', '#A00')
                    }

                return false;
            });
        }
    }
}) (jQuery)
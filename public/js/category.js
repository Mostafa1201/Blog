$(document).ready(function() {
    var addValidationErrors = $('#validation-errors-0');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#add-category-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/admin/dashboard/categories',
            data: $(this).serialize(),
            success: function (msg) {
                $(location).prop('pathname', '/categories');
            },
            error: function (ee) {
                if (ee.status === 401) {       //redirect if not authenticated user.
                    $(location).prop('pathname', '/admin/dashboard/login');
                }
                else if (ee.status === 422) {      //validation errors.
                    $errors = ee.responseJSON.errors;
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each( $errors, function( key, value ) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul></di>';
                    $(addValidationErrors).html(errorsHtml)
                    $(addValidationErrors).fadeIn(300);
                } else {
                    alert("SomeThing Went Wrong please try again");
                }
            }
        });
    });

    $('.edit-category-form').each(function() {
        var form = '#'+this.id;
        var categoryID = form.split('-')[3];
        var editValidationErrors = $('#validation-errors-'+categoryID);
        $(form).on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            data['_method'] = 'PUT';
            var url = $(form).attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function (msg) {
                    $(location).prop('pathname', '/categories');
                },
                error: function (ee) {
                    if (ee.status === 401) {       //redirect if not authenticated user.
                        $(location).prop('pathname', '/admin/dashboard/login');
                    }
                    else if (ee.status === 422) {      //validation errors.
                        $errors = ee.responseJSON.errors;
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each( $errors, function( key, value ) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul></di>';
                        $(editValidationErrors).html(errorsHtml)
                        $(editValidationErrors).fadeIn(300);
                    } else {
                        alert("SomeThing Went Wrong please try again");
                    }
                }
            });
        });
        $(document).on("input",'#input-'+categoryID ,function() {
            $(editValidationErrors).fadeOut(0);
        });

    });

    $('#add-category-form input').on('input',function (e) {
        $(addValidationErrors).fadeOut(0);
    });
});
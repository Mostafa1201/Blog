$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#add-post-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/admin/dashboard/posts',
            data: $(this).serialize(),
            success: function (msg) {
                $(location).prop('pathname', '/');
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
                    $( '.validation-errors' ).html(errorsHtml)
                    $('.validation-errors').fadeIn(300);
                } else {
                    alert("SomeThing Went Wrong please try again");
                }
            }
        });
    });

    $('#edit-post-form').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        data['_method'] = 'PUT';
        var url = $('#edit-post-form').attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (msg) {
                $(location).prop('pathname', '/');
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
                    $( '.validation-errors' ).html(errorsHtml)
                    $('.validation-errors').fadeIn(300);
                } else {
                    alert("SomeThing Went Wrong please try again");
                }
            }
        });
    });

});
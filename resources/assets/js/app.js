
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.modal:not(.no-reset)').on('show.bs.modal', function() {
        var form = $(this).find('form');
        if(!form.length){
            return;
        }
        form[0].reset();
        form.find('.invalid-feedback').remove();
        form.find('.is-invalid').removeClass('is-invalid')
    })
    $('form.ajax').submit(function (e) {
        e.preventDefault();

        var $this = $(this),
            submitBtn = $this.find('[type=submit]'),
            originalText = submitBtn.html(),
            formData = new FormData($this[0]);

        $this.find('.invalid-feedback').remove();
        $this.find('.is-invalid').removeClass('is-invalid')

        submitBtn.attr('disabled', 'disabled').html('<i class="fa fa-spin fa-spinner"></i> Loading...')

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if(res.hasOwnProperty('next_url')){
                    window.location.href = res.next_url;
                }else if($this.data('next-url')){
                    window.location.href = $this.data('next-url');
                }else{
                    window.location.reload();
                }
            },
            error: function (err) {
                if(err.status == 422){
                    // alertify.alert('Ooops!', 'Some fields contain errors. Please verify that all inputs are valid and try submitting again.');
                    var errors = err.responseJSON['errors'];

                    for(var field in errors){
                        var fieldName = field;
                        if(field.indexOf('.') !== -1){
                            var parts = field.split('.'),
                                name = parts.splice(0, 1),
                                newField = name+'['+parts.join('][')+']';

                            fieldName = newField;
                        }

                        console.log(fieldName)

                        var input = $this.find("[name=\""+fieldName+"\"]");
                        input.addClass('is-invalid');
                        if(input.closest('.form-group').length){
                            input.closest('.form-group').append('<div class="invalid-feedback">'+errors[field][0]+'</div>');
                        }else{
                            input.after('<div class="invalid-feedback d-block">'+errors[field][0]+'</div>');
                        }


                    }
                }else{
                    alert('An internal server error has occured!');
                    // alertify.alert('An internal server error has occured. Please refresh the page. If the error still persists. Please contact your system administrator.');
                }
            },
            complete: function () {
                submitBtn.removeAttr('disabled').html(originalText);
            }
        })
    })

    $('body').on('click', '.trash-row', function () {
        if(!confirm('Are you sure you want to delete this entry? This action cannot be undone!')) return;
        $(this).find('form').submit();
    });

    $('.logout').click(function () {
        if(!confirm('Are you sure you want to logout?')) return;
        $('#logout-form').submit();
    })

    // $('#num_puppies').attr('disabled', 'disabled')

    $('[name=sex]').change(function(event) {
        var val = $(this).val();
        if(val==='female'){
            $('#female_sex_extra').removeAttr('disabled');
        }else{
            $('#female_sex_extra')
                .val('')
                .attr('disabled', 'disabled');
            $('#num_puppies')
                .attr('disabled', 'disabled')
                .val('')
        }
    }).trigger('change');

    $('#female_sex_extra').change(function(event) {
        var val = $(this).val();
        if(val==='spayed'){
            $('#num_puppies')
                .attr('disabled', 'disabled')
                .val('')
        }else{
            $('#num_puppies').removeAttr('disabled')
        }
    });

});

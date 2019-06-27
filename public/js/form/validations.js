jQuery.validator.setDefaults({

    errorClass: 'errors', 
    errorElement: 'div',
    keyUp: true,

    errorPlacement: function (error, e) {
        error.hide().appendTo(e.parents('.form-group').children('div:first')).fadeIn()
    },

    highlight: function (e) {
        $(e).closest('.form-group').children('div:first').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.error').remove();
    },

    success: function(div){
        div.parents('.form-group').children('div:first').find('div.error').remove();
    },

    onfocusout: function(element) {
        this.element(element);
    },
});

$('#form').validate({
    rules: {
        "user[name]": {
            letras: true,
            maxlength: 255
        },
        "user[email]": {
            email:true
        },
        "email": {
            email:true
        },
        "user[password]": {
            minlength: 8
        },
        "user[password_confirmation]": {
            equalTo: "#password"
        },
        "phones[][number]": {
            digits: true,
        },
    },
    messages:{}
})

jQuery.validator.addMethod("email", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
  }, 'Insira um e-email válido');

jQuery.validator.addMethod("letras", function(value, element) {
    return this.optional( element ) || /^[a-záàâãéèêíïóôõöúçñ ]+$/i.test( value );
}, 'Caracteres inválidos');


//FUNÇÃO PARA CLONAR UM ELEMENTO
function clone(target, local, indices) {
    var clone = $(target).last().clone()
    clone.find(".errors").remove()
    clone.hide().fadeIn("fast").appendTo(local)

    if(indices) {
        $(target).last().find('input, select').each(function(i, input) {
            var index = $(this).attr('name').split('[')[1].split(']')[0]
            $(this).attr('name', $(this).attr('name').replace(index, parseInt(index) + 1))
            $(this).attr('id', $(this).attr('name'))
        })
    }
}

//FUNÇÃO PARA REMOVER UM ELEMENTO
function remove(target, buttonClicked) {
    $(buttonClicked).closest(target).remove()
}

function maskPhone(element) {

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    
    $(element).mask(SPMaskBehavior, spOptions);
}

//###########################

$(document).ready(function() {

    $(".phone").each(function() {
        maskPhone($(this))
    })

    //ADICIONA E REMOVE TELEFONES
    $(document).on("click", ".add-phone", function() {
        if($(".phone-group").length < 4) {
            clone(".phone-group", "#phones", true)
            $(".phone-group").last().find("input").val("")
            maskPhone($(".phone-group").last().find("input"))
        } else {
            Swal.fire({
                type: 'warning',
                title: 'Atenção!',
                text: 'Deve possuir no máximo '+$(".phone-group").length+' telefones!',
            })
        }
    })

    $(document).on("click", ".del-phone", function() {
        if($(".phone-group").length > 1) {
            remove(".phone-group", $(this))
        } else {

            Swal.fire({
                type: 'warning',
                title: 'Atenção!',
                text: 'Deve possuir no mínimo 1 telefone!',
            })
        }
    })

})


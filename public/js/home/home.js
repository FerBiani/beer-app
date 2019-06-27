$(document).ready(function() {

    load(page)

    $(document).on('click', '#filter', function(e) {

        e.preventDefault()

        parameters = ''

        if($('#name').val() != ''){
            parameters += '&beer_name='+$('#name').val().split(' ').join('_')
        }

        if($('#malt').val() != ''){
            parameters += '&malt='+$('#malt').val().split(' ').join('_')
        }

        if($('#food').val() != ''){
            parameters += '&food='+$('#food').val().split(' ').join('_')
        }

        page = 1
        load(page, parameters)

    })

})
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});

function alertMsg(msg, type) {
    Toast.fire({
        type: type,
        title: msg
    })
}

var page = parseInt($("#page").text())
var parameters = ''

function load(p, param) {
    $.ajax({
        method: "GET",
        url: "https://api.punkapi.com/v2/beers?page="+p+"&per_page=10&"+param,
        success: function(data) {
            if(data == ''){
                alertMsg('Sem Resultados!', 'warning')
                page = parseInt($("#page").text())
                return false;
            } 
            let content = ''
            $.each(data, function(i, val) {
                content += 
                    '<tr>'+
                        '<td>'+val.name+'</td>'+
                        '<td>'+val.tagline+'</td>'+
                        '<td>'+val.first_brewed+'</td>'+
                        '<td><button onclick=loadOne('+val.id+') class="btn btn-primary rounded more" id="beer-'+val.id+'"><i class="fas fa-question fa-lg"></i></button></td>'+
                        '<td><button onclick=setAsFavorite('+val.id+') class="btn btn-primary rounded star" id="star-'+val.id+'"><i class="fas fa-star fa-lg"></i></button></td>'
                    '</tr>'
            })
            $("#result").html(content)
            $("#page").text(page)
            verifyFavorites()
        },
        error: function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus )
        }
    })
}

function loadOne(id) {
    $.ajax({
        method: "GET",
        url: "https://api.punkapi.com/v2/beers?ids="+id,
        success: function(data) {

            var food_pairing = ''
            var malt = ''

            $.each(data[0].food_pairing, function(i, food) {
                food_pairing += '<li class="list-group-item">'+food+'</li>'
            })

            $.each(data[0].ingredients.malt, function(i, m) {
                malt += '<li class="list-group-item">'+m.name+'</li>'
            })

            var htmlData =
            '<hr>' +
            '<p><b>Slogan:</b> '+data[0].tagline+'</p>' +
            '<p><b>Primeira Fabricação: </b> '+data[0].first_brewed+'</p>' +
            '<hr>' +
            '<h5>Descrição:</h5>' +
            '<p>'+data[0].description+'</p>' +
            '<br>'+
            '<h5>Malte:</h5>' +
            '<ul class="list-group">' +
                malt+
            '</ul>'+
            '<br>'+
            '<h5>Combina com:</h5>' +
            '<ul class="list-group">' +
                food_pairing+
            '</ul>'

            Swal.fire({
                title: data[0].name,
                html: htmlData,
                imageUrl: data[0].image_url,
                imageWidth: '20%',
                imageHeight: '250px',
                imageAlt: 'Custom image',
                showCloseButton: true,
                showConfirmButton: false,
            })
        },
        error: function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus )
        }
    })
}

function next() {
    load(++page, parameters)
}

function previous() {
    if(page > 1) {
        load(--page, parameters)
    }
}

function verifyFavorites() {
    $.ajax({
        method: "GET",
        url: main_url+'/verify-favorites',
        success: function(data) {
            $('.star').each(function() {
                var id = parseInt(this.id.split('-')[1])
                if(data.includes(id)) {
                    $(this).addClass('star-icon-yellow')
                }
            })
        },
        error: function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus )
        },
    })
}

function getFavorites() {
    $.ajax({
        method: "GET",
        url: main_url+'/verify-favorites',
        success: function(data) {

           if(data == '') {
               $("#result").html('<h3 class="mt-2">Você não possui nenhum favorito.</h3>')
           }

           var ids = data.join('|')

           parameters = 'ids='+ids
           load(1, parameters)
        },
        error: function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus )
        },
    })
}

function setAsFavorite(id) {

    $.ajaxSetup({
        headers: {
          'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: main_url+'/star',
        data: {'id': id},
        success: function(data) {
            if(data == 'add') {
                $("#star-"+id).addClass('star-icon-yellow')
                alertMsg('Adicionado aos favoritos!', 'success')
            }

            if(data == 'remove') {
                $("#star-"+id).removeClass('star-icon-yellow')
                alertMsg('Removido dos favoritos!', 'success')
            }
        },
        error: function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus )
        },
    })

}

$(".send-form").on('click',function(){
    if($("#form").valid()){
        $(".send-form").prop("disabled",true) 
        $("#form").submit()  
    }
})
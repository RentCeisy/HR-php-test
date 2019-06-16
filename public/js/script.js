$(document).ready(function () {
    $('#changePrice').click(function (e) {
        e.preventDefault();
        var price = $($('#changePrice').parent()[0].children[0]).val();
        var id = $($('#changePrice').parent()[0].children[1]).val();
        $.ajax({
            url: '/changePrice',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'JSON',
            data: {
                price,
                id
            },
            success(response) {
                $('.productMsg-' + response.id).html(response.result)
            },
            error(response) {
                $('.productMsg-' + response.id).html('Все поломалось')
            }
        })
    })

})
$(document).ready(function(){
    var url = "/modal";

    //listar produtos
    $('.product-modal').click(function(){
        var product_id = $(this).data('id');
        console.log(product_id);

        $.get(url + '/' + product_id, function (data) {
            //success data
            console.log(data);

            $( '#task' ).html(data.table);
            $( '#titulo' ).text(data.name);
            $('#myModal').modal('show');
        })
    });
});

$(document).ready(function(){
    var url = "/tasks";

    //listar produtos
    $('.order-modal').click(function(){
        var task_id = $(this).data('id');
        console.log(task_id);

        $.get(url + '/' + task_id, function (data) {
            //success data
            console.log(data);

            $( '#task' ).html(data.table);
            $( '#titulo' ).text(data.name);
            $('#myModal').modal('show');
        })
    });
});
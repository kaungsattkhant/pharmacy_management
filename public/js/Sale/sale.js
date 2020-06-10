function detail(id) {
    $.ajax({
        url: '/sale/' + id + '/detail',
        data: "get",
        success:function (data) {
            // console.log(data);
            $('#detail').modal('show');

            // $('#detail').modal('show');
            $('div #detail_modal').html(data);
        }
    });
}

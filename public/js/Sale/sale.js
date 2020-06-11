$(function () {
    $('#sale_record_filter').click(function () {
        var branch_id=$('#sale_branch').val();
        var check_from_date = $('.from_date').datepicker('getDate');
        var check_to_date = $('.to_date').datepicker('getDate');
        if(typeof branch_id ==="undefined"){
            if (check_from_date != null && check_to_date != null) {
                var from_date = $('.from_date').val();
                var to_date = $('.to_date').val();
                $.ajax({
                    url: '/sale/sale_record_filter',
                    type: 'get',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#sale_filter').html(response);
                    }
                });
            } else {
                alert('Empty');
            }
        }else if(branch_id!=null){
            if (check_from_date != null && check_to_date != null) {
                var from_date = $('.from_date').val();
                var to_date = $('.to_date').val();
                $.ajax({
                    url: '/sale/sale_record_filter',
                    type: 'get',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        branch:branch_id,
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#sale_filter').html(response);
                    }
                });
            } else {
                alert('Empty');
            }
        }else{
            alert('Please Choose Branch');
        }


    });
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var branch_id=$('#sale_branch');
        var check_from_date=$('.from_date').datepicker('getDate');
        var check_to_date=$('.to_date').datepicker('getDate')
        if(typeof branch_id=== "undefined"){
            if(check_from_date !=null && check_to_date !=null){
                branch_filter(page);
            }else{
                fetch_data(page);
            }
        }else{
            if(check_from_date !=null && check_to_date !=null){
                filter(page);
            }else{
                fetch_data(page);
            }
        }

    });
    function filter(page) {
        var from_date=$('.from_date').val();
        var to_date=$('.to_date').val();
        $.ajax({
            url:'/sale/sale_record_filter?page='+page,
            type:'get',
            data:{
                from_date:from_date,
                to_date:to_date,
            },
            success:function (response) {
                console.log(response);
                $('#sale_filter').html(response);

            }
        });
    }
    function branch_filter(page) {
        var branch_id=$('#sale_branch').val();
        var from_date=$('.from_date').val();
        var to_date=$('.to_date').val();
        $.ajax({
            url:'/sale/sale_record_filter?page='+page,
            type:'get',
            data:{
                branch:branch_id,
                from_date:from_date,
                to_date:to_date,
            },
            success:function (response) {
                console.log(response);
                $('#sale_filter').html(response);

            }
        });
    }
    function fetch_data(page)
    {
        $.ajax({
            url:"/sale/sale_record?page="+page,
            type:'get',
            success:function(data)
            {
                $('#sale_filter').html(data);
            }
        });
    }
});
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


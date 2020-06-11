$(function () {
    $('#item_report_filter').click(function () {
        var branch_id=$('#item_branch').val();
        var check_from_date = $('.from_date').datepicker('getDate');
        var check_to_date = $('.to_date').datepicker('getDate');
        if (check_from_date != null && check_to_date != null) {
            var from_date = $('.from_date').val();
            var to_date = $('.to_date').val();
            $.ajax({
                url: '/sale/item_report_filter',
                type: 'get',
                data: {
                    branch:branch_id,
                    from_date: from_date,
                    to_date: to_date,
                },
                success: function (response) {
                    // console.log(response);
                    $('#item_report').html(response);
                }
            });
        } else {
            alert('Empty');
        }
    });
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var check_from_date=$('.from_date').datepicker('getDate');
        var check_to_date=$('.to_date').datepicker('getDate');
        if(check_from_date !=null && check_to_date !=null){
            filter(page);
        }else{
            fetch_data(page);
        }
    });
    function filter(page) {
        var branch_id=$('#item_branch').val();
        var from_date=$('.from_date').val();
        var to_date=$('.to_date').val();
        $.ajax({
            url:'/sale/item_report_filter?page='+page,
            type:'get',
            data:{
                branch:branch_id,
                from_date:from_date,
                to_date:to_date,
            },
            success:function (response) {
                console.log(response);
                $('#item_report').html(response);

            }
        });
    }
    function fetch_data(page)
    {
        $.ajax({
            url:"/sale/item_report?page="+page,
            type:'get',
            success:function(data)
            {
                $('#item_report').html(data);
            }
        });
    }
});

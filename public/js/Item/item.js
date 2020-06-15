$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#editMessage').hide();
    $('#createMessage').hide();


    $('#itemSubmit').click( function(event) {
        var name=$('#name').val();
        var price=$('#price').val();
        var category=$('#category').val();
        var qty=$('#qty').val();
        var expire_date=$('#expire_date').val();
        var branch=$('#branch').val();
        // role===1 ? branch=null :branch=$('#b').val();
        event.preventDefault();
        $.ajax({
            url:'/item/store',
            type:'POST',
            data:{
                name:name,
                price:price,
                category:category,
                qty:qty,
                branch:branch,
                expire_date:expire_date,
            },
            success:function(data)
            {
                console.log(data.errors);
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.price){
                        $( '#price_error' ).html( data.errors.price[0] );
                    }
                    if(data.errors.category){
                        $( '#category_error' ).html( data.errors.category[0] );
                    }
                    if(data.errors.qty){
                        $( '#qty_error' ).html( data.errors.qty[0] );
                    }
                    if(data.errors.branch){
                        $( '#branch_error' ).html( data.errors.branch[0] );
                    }
                    if(data.errors.expire_date){
                        $( '#expire_date_error' ).html( data.errors.expire_date[0] );
                    }
                }
                if(data.is_success==true)
                {
                    $('#createMessage').show();
                    $( "#success").html(data.message);
                    setTimeout(function() {
                        $('#item_create').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });
    $('#itemSubmit1').click(function(event){
        var name = $("#name1").val();
        var price = $("#price1").val();
        var category=$('#category1').val();
        var qty=$('#qty1').val();
        var branch=$('#branch1').val();
        var expire_date=$('#expire_date1').val();
        // role==1 ? branch=null :branch=$('#branch1').val();
        var id=$('#id').val();
        $('#name1').html("");
        $('#price1').html("");
        // $('#category1').html("");
        event.preventDefault();
        $.ajax({
            url:'item/update',
            type:'POST',
            data:{
                id:id,
                name:name,
                price:price,
                category:category,
                qty:qty,
                branch:branch,
                expire_date:expire_date,
            },
            success:function(data)
            {
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error1' ).html( data.errors.name[0] );
                    }
                    if(data.errors.price){
                        $( '#price_error1' ).html( data.errors.price[0] );
                    }
                    if(data.errors.category){
                        $( '#category_error1' ).html( data.errors.category[0] );
                    }
                    if(data.errors.qty){
                        $( '#qty_error1' ).html( data.errors.qty[0] );
                    }
                    if(data.errors.branch){
                        $( '#branch_error1' ).html( data.errors.branch[0] );
                    }
                    if(data.errors.expire_date){
                        $( '#expire_date_error1' ).html( data.errors.expire_date[0] );
                    }

                }
                if(data.is_success==true)
                {
                    // $('#editAdmin').delay(300).modal('toggle');
                    $('#editMessage').show();
                    $( "#success1" ).html(data.message);
                    setTimeout(function() {
                        $('#item_edit').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });

    $('#item_index_filter').click(function () {
        var branch_id=$('#item_branch').val();
        var sort_by=$('#sort_by').val();
        // var check_from_date = $('.from_date').datepicker('getDate');
        // var check_to_date = $('.to_date').datepicker('getDate');
        if (branch_id != null) {
            $.ajax({
                url: '/item/item_filter',
                type: 'get',
                data: {
                    branch:branch_id,
                    sort_by:sort_by,
                },
                success: function (response) {
                    // console.log(response);
                    $('#item_filter').html(response);
                }
            });
        } else {
            alert('Empty');
        }
    });
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        // var check_from_date=$('.from_date').datepicker('getDate');
        // var check_to_date=$('.to_date').datepicker('getDate');
        var branch_id=$('#item_branch').val();
        if(branch_id!=null){
            filter(page);
        }else{
            fetch_data(page);
        }
    });
    function filter(page) {
        var branch_id=$('#item_branch').val();
        var sort_by=$('#sort_by').val();
        $.ajax({
            url:'/item/item_filter?page='+page,
            type:'get',
            data:{
               branch:branch_id,
                sort_by:sort_by,
            },
            success:function (response) {
                console.log(response);
                $('#item_filter').html(response);
            }
        });
    }
    function fetch_data(page)
    {
        $.ajax({
            url:"/item?page="+page,
            type:'get',
            success:function(data)
            {
                $('#item_filter').html(data);
            }
        });
    }


    // $('#admin_changePass').click(function(event){
    //     var id=$('#changePasswordId').val();
    //     var password=$('#password2').val();
    //     var password_confirmation=$('#password_confirmation2').val();
    //     $('#password_error2').html("");
    //     $('#password_confirmation_error2').html("");
    //     event.preventDefault();
    //     $.ajax({
    //         url:'staff/change_pass',
    //         type:'POST',
    //         data:{
    //             id:id,
    //             password:password,
    //             password_confirmation:password_confirmation,
    //         },
    //         success:function(data)
    //         {
    //             console.log(data);
    //             if(data.errors)
    //             {
    //
    //                 if(data.errors.password){
    //                     $( '#password_error2' ).html( data.errors.password[0] );
    //                 }
    //                 if(data.errors.password_confirmation){
    //                     $( '#password_confirmation_error2').html( data.errors.password_confirmation[0] );
    //                 }
    //             }
    //             if(data.success==true)
    //             {
    //                 $('#changepass').modal('toggle');
    //                 location.reload();
    //             }
    //
    //         },
    //     });
    //
    // });

});
function editItem(id)
{
    $.ajax({
        url: "item/" + id + "/edit",
        data: "get",
        dataType: "json",
        success: function (data) {
            $('#id').val(data.id);
            $('#price1').val(data.price);
            $('#qty1').val(data.qty);
            $('#name1').val(data.name);
            $('#expire_date1').val(data.expire_date);
            $('#category1 option').prop('selected',false);
            $('#category1 option[value="'+data.category_id+'"]' ).prop('selected','selected');
            $('#branch1 option').prop('selected',false);
            $('#branch1 option[value="'+data.branch_id+'"]' ).prop('selected','selected');
            $('#item_edit').modal('show');
        }
    });
}
function destroyItem($id) {
    $('#delete_id').val($id);
    $('#item_destroy').modal('show');
}

function addQty(id) {
    $('#item_id').val(id);
    $('#item_add_qty').modal('show');

}

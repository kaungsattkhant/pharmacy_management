$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $("#staff a").addClass("active-staff");
    // $("#staff").addClass("active2");

    $('#editMessage').hide();
    $('#createMessage').hide();
    $('div .role_branch_filter').on('change',function () {
        var id=$(this).val();
        if(id==1)
        {
            $('.branch_div').fadeOut();
        }
        else
        {
            $('.branch_div').fadeIn();
        }
    });

    $('#staffSubmit').click( function(event) {
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var email=$('#email').val();
        var name=$('#name').val();
        var role=$('#role').val();
        // var branch=$('#branch').val();
        role===1 ? branch=null :branch=$('#b').val();
        event.preventDefault();
        $.ajax({
            url:'/staff/store',
            type:'POST',
            data:{
                name:name,
                email:email,
                password:password,
                password_confirmation:password_confirmation,
                role:role,
                branch:branch,
            },
            success:function(data)
            {
                console.log(data.errors);
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.role){
                        $( '#role-error' ).html( data.errors.role[0] );
                    }
                    if(data.errors.email){
                        $( '#email-error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.branch){
                        $( '#branch-error' ).html( data.errors.branch[0]);
                    }
                    if(data.errors.password){
                        $( '#password-error' ).html( data.errors.password[0]);
                    }
                    if(data.errors.password_confirmation){
                        $( '#password_confirmation-error' ).html( data.errors.password_confirmation[0] );
                    }
                }
                if(data.success==true)
                {
                    $('#createMessage').show();
                    $( "#success").html(data.message);
                    setTimeout(function() {
                        $('#create').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });
    $('#staffSubmit1').click(function(event){
        var email = $("#email1").val();
        var name = $("#name1").val();
        var role=$('#role1').val();
        // var branch=$('#branch1').val();
        role==1 ? branch=null :branch=$('#branch1').val();
        var id=$('#id').val();
        $('#phone_number-error1').html("");
        $('#name1').html("");
        $('#show-success').html("");
        $('#email-error1').html("");
        event.preventDefault();
        $.ajax({
            url:'staff/update',
            type:'POST',
            data:{
                id:id,
                name:name,
                email:email,
                role:role,
                branch:branch,
            },
            success:function(data)
            {
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error1' ).html( data.errors.name[0] );
                    }
                    if(data.errors.email){
                        $( '#email-error1' ).html( data.errors.email[0] );
                    }
                    if(data.errors.role){
                        $( '#role-error1' ).html( data.errors.role[0] );
                    }
                    if(data.errors.branch){
                        $( '#branch-error1' ).html( data.errors.branch[0] );
                    }
                }
                if(data.success==true)
                {
                    // $('#editAdmin').delay(300).modal('toggle');
                    $('#editMessage').show();
                    $( "#success1" ).html(data.message);
                    setTimeout(function() {
                        $('#edit').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });
    $('#staff_branch').click(function () {
        var branch_id=this.value;
        if (branch_id != null) {
            $.ajax({
                url: '/staff/staff_filter',
                type: 'get',
                data: {
                    branch:branch_id
                },
                success: function (response) {
                    // console.log(response);
                    $('#staff_filter').html(response);
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
        var branch_id=$('#staff_branch').val();
        if(branch_id!=null){
            filter(page);
        }else{
            fetch_data(page);
        }
    });
    function filter(page) {
        var branch_id=$('#staff_branch').val();
        $.ajax({
            url:'/staff/staff_filter?page='+page,
            type:'get',
            data:{
                branch:branch_id,
            },
            success:function (response) {
                console.log(response);
                $('#staff_filter').html(response);
            }
        });
    }
    function fetch_data(page)
    {
        $.ajax({
            url:"/staff?page="+page,
            type:'get',
            success:function(data)
            {
                $('#staff_filter').html(data);
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
function editStaff(id)
{
    $.ajax({
        url: "staff/" + id + "/edit",
        data: "get",
        dataType: "json",
        success: function (data) {
            if(data.role_id==1){
                $('.branch1').hide();
            }else{
                $('.branch1').show();
            }
            $('#id').val(data.id);
            $('#email1').val(data.email);
            $('#name1').val(data.name);
            $('#role1 option').prop('selected',false);
            $('#role1 option[value="'+data.role_id+'"]' ).prop('selected','selected');
            $('#branch1 option').prop('selected',false);
            $('#branch1 option[value="'+data.branch_id+'"]' ).prop('selected','selected');
            // $('#role1').selectpicker('refresh');
            // $('#branch1').selectpicker('refresh');
            $('#staff_edit').modal('show');
        }
    });
}

function destroyStaff($id) {
    $('#delete_id').val($id);
    $('#staff_destroy').modal('show');
}

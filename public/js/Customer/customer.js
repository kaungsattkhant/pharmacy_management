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
    // $('div .role_branch_filter').on('change',function () {
    //     var id=$(this).val();
    //     if(id==1)
    //     {
    //         // console.log('alert');
    //         $('.branch_div').fadeOut();
    //     }
    //     else
    //     {
    //         $('.branch_div').fadeIn();
    //     }
    // });

    $('#customerSubmit').click( function(event) {
        var email=$('#email').val();
        var name=$('#name').val();
        var address=$('#address').val();
        var phone_number=$('#phone_number').val();
        var pulse_rate=$('#pulse_rate').val();
        var nrc=$('#nrc').val();
        var special_note=$('#special_note').val();
        // role===1 ? branch=null :branch=$('#b').val();
        event.preventDefault();
        $.ajax({
            url:'/customer/store',
            type:'POST',
            data:{
                name:name,
                email:email,
                phone_number:phone_number,
                address:address,
                pulse_rate:pulse_rate,
                nrc:nrc,
                special_note:special_note
            },
            success:function(data)
            {
                console.log(data.errors);
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.phone_number){
                        $( '#phone_number_error' ).html( data.errors.phone_number[0] );
                    }
                    if(data.errors.email){
                        $( '#email_error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.pulse_rate){
                        $( '#pulse_rate_error' ).html( data.errors.pulse_rate[0]);
                    }
                    if(data.errors.address){
                        $( '#address_error' ).html( data.errors.address[0]);
                    }
                    if(data.errors.special_note){
                        $( '#special_note_error' ).html( data.errors.special_note[0]);
                    }
                    if(data.errors.nrc){
                        $( '#nrc_error' ).html( data.errors.nrc[0]);
                    }
                }
                if(data.is_success==true)
                {
                    $('#createMessage').show();
                    $( "#success").html(data.message);
                    setTimeout(function() {
                        $('#customer_create').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });
    $('#customerSubmit1').click(function(event){
        var email = $("#email1").val();
        var name = $("#name1").val();
        var address=$('#address1').val();
        var phone_number=$('#phone_number1').val();
        var pulse_rate=$('#pulse_rate1').val();
        var id=$('#id').val();
        var nrc=$('#nrc1').val();
        var special_note=$('#special_note1').val();
        $('#phone_number-error1').html("");
        $('#name1').html("");
        $('#show-success').html("");
        $('#email-error1').html("");
        event.preventDefault();
        $.ajax({
            url:'customer/update',
            type:'POST',
            data:{
                id:id,
                name:name,
                email:email,
                phone_number:phone_number,
                address:address,
                pulse_rate:pulse_rate,
                nrc:nrc,
                special_note:special_note
            },
            success:function(data)
            {
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error1' ).html( data.errors.name[0] );
                    }
                    if(data.errors.phone_number){
                        $( '#phone_number_error1' ).html( data.errors.phone_number[0] );
                    }
                    if(data.errors.email){
                        $( '#email_error1' ).html( data.errors.email[0] );
                    }
                    if(data.errors.pulse_rate){
                        $( '#pulse_rate_error1' ).html( data.errors.pulse_rate[0]);
                    }
                    if(data.errors.address){
                        $( '#address_error1' ).html( data.errors.address[0]);
                    }
                    if(data.errors.special_note){
                        $( '#special_note_error1' ).html( data.errors.special_note[0]);
                    }
                    if(data.errors.nrc){
                        $( '#nrc_error1' ).html( data.errors.nrc[0]);
                    }
                }
                if(data.is_success==true)
                {
                    // $('#editAdmin').delay(300).modal('toggle');
                    $('#editMessage').show();
                    $( "#success1" ).html(data.message);
                    setTimeout(function() {
                        $('#customer_edit').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });

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
function editCustomer(id)
{
    $.ajax({
        url: "customer/" + id + "/edit",
        data: "get",
        dataType: "json",
        success: function (data) {
            $('#id').val(data.id);
            $('#email1').val(data.email);
            $('#name1').val(data.name);
            $('#nrc1').val(data.nrc);
            $('#phone_number1').val(data.phone_number);
            $('#pulse_rate1').val(data.pulse_rate);
            $('#address1').val(data.address);
            $('#special_note1').val(data.special_note);
            $('#customer_edit').modal('show');
        }
    });
}

function destroyCustomer($id) {
    $('#delete_id').val($id);
    $('#customer_destroy').modal('show');
}

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#editMessage').hide();
    $('#createMessage').hide();
    $('#categorySubmit').click( function(event) {
        var name=$('#name').val();
        // role===1 ? branch=null :branch=$('#b').val();
        event.preventDefault();
        $.ajax({
            url:'/category/store',
            type:'POST',
            data:{
                name:name,

            },
            success:function(data)
            {
                console.log(data.errors);
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error' ).html( data.errors.name[0] );
                    }

                }
                if(data.is_success==true)
                {
                    $('#createMessage').show();
                    $( "#success").html(data.message);
                    setTimeout(function() {
                        $('#category_create').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });
    $('#categorySubmit1').click(function(event){
        var name = $("#name1").val();
        var id=$('#id').val();
        $('#name1').html("");
        $('#show-success').html("");
        event.preventDefault();
        $.ajax({
            url:'category/update',
            type:'POST',
            data:{
                id:id,
                name:name,
            },
            success:function(data)
            {
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error1' ).html( data.errors.name[0] );
                    }

                }
                if(data.is_success==true)
                {
                    $('#editMessage').show();
                    $( "#success1" ).html(data.message);
                    setTimeout(function() {
                        $('#category_edit').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });


});
function editCategory(id)
{
    $.ajax({
        url: "category/" + id + "/edit",
        data: "get",
        dataType: "json",
        success: function (data) {
            $('#id').val(data.id);
            $('#name1').val(data.name);
            $('#category_edit').modal('show');
        }
    });
}

function destroyCategory($id) {
    $('#delete_id').val($id);
    $('#category_destroy').modal('show');
}

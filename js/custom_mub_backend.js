$(document).ready(function(){
	$('#mub-state').on('change',function(){
    var selected = $("#mub-state option:selected").val();
    $.ajax({
         type:'POST',
         url:"/mub-admin/users/user/get-city",
         data:{stateId:selected},
            success: function(result){
                $('#mubusercontact-city').children("option").remove();
                $('#mubusercontact-city').prop("disabled", false);
                $('#mubusercontact-city').append(new Option('Select', ''));
                $.each(result.result, function (i, item) {
                    $('#mubusercontact-city').append(new Option(item.city_name, item.id));
                });
            }
        }); 
    });

    //Resources page type selection
    if($('#resources-type').length > 0){
        $('#resources-type').on('change',function(){
        var selected = $("#resources-type option:selected").val();
        if(selected === 'file'){
            $('#resource-url-file').css('display','block');
            $('#resource-url-path').css('display','none');
            $('#resources-url').val('');
            $('#resources-duration').val('');
        }
        else
        {
            $('#resource-url-file').css('display','none');
            $('#resource-url-path').css('display','block');
            $('#resources-url').val('');
        }
     });
    }
    //Resource page price type selection
    if($('#resources-free').length > 0){
        $('#resources-free').on('change',function(){
        var selected = $("#resources-free option:selected").val();
        if(selected === 'free'){
            $('#resource-paid').css('display','none');
            $('#resources-price').val('');
        }
        else
        {
            $('#resource-paid').css('display','block');
            $('#resources-price').val('');
        }
     });
    }
    // Code for adding dynamic buttons
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    window.x = $('#initialResponses').val(); //Initial field counter is 1
   // var fieldHTML = '<div><label class="control-label" for="question-response">Option '+window.x+'</label><input type="text" name="responses[]" class="form-control" value=""><a href="javascript:void(0);" class="remove_button"><img src="/images/remove-icon.png"/></a></div>'; //New input field html 
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(window.x < maxField){ 
            window.x++; //Increment field counter
            optionIndex = x-1;
            fieldHTML = '<div><label class="control-label" for="question-options">Option '+window.x+'</label><input type="text" name="options_eng[]" placeholder="option value in English" class="form-control" value=""/><input type="text" name="options_hi[]" placeholder="option value in Hindi" class="form-control" value=""/></a><input type="radio" name="correctOption" value="'+ optionIndex +'"> Correct Answer <a href="javascript:void(0);" class="remove_button"><img src="/images/remove-icon.png"/></div>';
            $(wrapper).append(fieldHTML); //Add field html
            console.log('current button = '+ window.x);
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        window.x--; //Decrement field counter
        console.log('current button = '+ window.x);
    });
    //Adding custom Validation for newly added fields

    $('#addSingleQuestion').on('beforeSubmit',function(){
        $('#addSingleQuestion input:text[name="options_eng"]').each(function(){
            if($(this).val() === ''){
                $(this).addClass('error');
                alert('No options text field can be left blank');
            }
        });
    });

    // Code for adding dynamic buttons
    $('.comment-text').hover(function(){
        var id = $(this).find('a:first').attr('id');
        $('.reply-box-'+id).css('display','block');
    },function(){
        var id = $(this).find('a:first').attr('id');
        $('.reply-box-'+id).css('display','none');
    });

    $('.post-reply').on('click',function(){
        var replyId = $(this).attr('id');
        var replyText = $('.reply-box-'+replyId+' textarea').val();
        console.log(replyText); 
    });

});

var setModelAttribute = function(model,attribute,value,id)
{
    var dataArray = {model:model,attribute:attribute,value:value,id:id};
    $.ajax({
     type:'POST',
     url:"/mub-admin/dashboard/set-attribute",
     data:dataArray,
        success: function(result){
            if(result)
            {
                location.reload();
            }
        }
    }); 
};

var approveComment = function(commentId)
{
    $.ajax({
         type:'POST',
         url:"/mub-admin/blog/comments/approve-comment",
         data:{commentId:commentId},
        success: function(result)
        {
            if(result)
            {
                alert('Selected Comment has been approved');
            }
            else
            {
               alert('Comment could not be approced by you'); 
            }
            location.reload();
        }
    }); 
}
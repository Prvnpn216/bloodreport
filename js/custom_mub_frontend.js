$(document).ready(function(){
	$('#user_comment').on('submit',function(e){
		e.preventDefault();
		$('#user_comment').yiiActiveForm('validate', true);
		$(':input[type="submit"]').prop('disabled', true); 
		if(!($(this).hasClass('has-error')))
		{
			//only if the form does not has an error
			var form = $(this).serialize();
			$.ajax({
	         type:'POST',
	         url:"/blog/add-comment",
	         data:form,
	        	success: function(result){
	        		$(':input[type="submit"]').prop('disabled', false);
	        		if(result!=='')
	        		{
		        		alert('Your Comment is sent for approval and will be displayed if approved');
		        		location.reload();
	        		}
	        		return false;
	        	}
	    	}); 
		return false;

		}
	});

});

	var readmore = function(id){
		$('.show-less'+id).css('display','none');
		$('.show-more'+id).css('display','block');
	};

	var readless = function(id){
		$('.show-more'+id).css('display','none');
		$('.show-less'+id).css('display','block');
	};

$(window).scroll(function() {
    var scrollVal = $(this).scrollTop();
    if (scrollVal > 450) {
        $('.navbar').css('display', 'block');
    } else {
        $('.navbar').css('display', 'none');
    }
});
$(document).ready(function() {
    $('.message-input').on('keyup', function() {
      let empty = false;
  
      $('.message-input').each(function() {
        empty = $(this).val().length == 0 || $(this).val().length == '' ;
      });
  
      if (empty)
        $('.message-btn').attr('disabled', 'disabled');
      else
        $('.message-btn').attr('disabled', false);
    });
    
    $("#MessageCreateForm").submit(function (e) {
        //stop submitting the form to see the disabled button effect
        e.preventDefault();
        //serialize form data
        let formData = $(this).serialize();
        //get form action
        let formUrl = $(this).attr('action');
        
        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(data,textStatus,xhr){
                    //alert(data);
                   
            },
            error: function(xhr,textStatus,error){
                    alert(textStatus);
            }
        });	
        $('#message-input').val('');
            
        return false;
        
    });
var x = 10;
    
    $('#show-more-msg').click(function(e) {
        e.preventDefault();
        let formUrl = $(this).attr('href'),
            user = $(this).attr('data-user-id'),
            reciever = $(this).attr('data-reciever-id')
            post_per_page = 10 ,
            offset = x;
        
        let formData = {
            offset: offset ,
            count: post_per_page,
            user: user,
            reciever: reciever
        };
        
        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(data,textStatus,xhr){
                   x = offset + 10;
                   
            },
            error: function(xhr,textStatus,error){
                    alert(textStatus);
            }
        });
        
        
        
    });
    
    
    
    
    
    
    
    
    
  });
  
  
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
            success: function(res,textStatus,xhr){
                x = offset + 10;
                console.log(res.data)
                
                if(res.data.length == 0) {
                    $('#show-more-msg').replaceWith('No more messages to show.');
                }
                
                $.each(res.data, function(i, val) {
                    // console.log(val)
                    makeMsgDiv(val, res.user, res.reciever);
                })
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
        
        
        
    });
    
    function myAddClass(element, className = Array()) {
        $.each(className, function(i, val) {
            element.classList.add(val);
        })
    }
    
    
    function makeMsgDiv(res, user, reciever) {    
        let main_div = document.createElement('div');
        let div_msg = main_div.cloneNode();
        let div_pic = main_div.cloneNode();
        let img = document.createElement('img');
        let userMsgDivClass = [
            'message-div',
            'col-9',
            'alert',
            'alert-secondary',
            'offset-1'
        ];
        let recieverMsgDivClass = [
            'message-div',
            'col-9',
            'alert',
            'alert-primary'
        ];
        
        div_msg.setAttribute('msg-id', res.message.id)
        div_msg.textContent = res.message.content
        myAddClass(main_div, ['row'])
        myAddClass(div_pic, ['col-2'])
        myAddClass(img, ['rounded-circle', 'user-pic'])
        
        if(res.message.from_id == user.id) {
            avatar = 'https://ui-avatars.com/api/?name=' + user.name;
            
            if(user.image){
                avatar = '/chat/img/' + user.image
            }
            
            img.setAttribute('src', avatar);
        
            myAddClass(div_msg , userMsgDivClass);
            
            
            main_div.appendChild(div_msg);
            div_pic.appendChild(img)
            main_div.appendChild(div_pic);
            
            
        } else if(res.message.from_id == reciever.id) {
            avatar = 'https://ui-avatars.com/api/?name=' + reciever.name;
            
             
            if(reciever.image){
                avatar = '/img/'+reciever.image
            }
            img.setAttribute('src', avatar);
            
            myAddClass(div_msg , recieverMsgDivClass);
            main_div.appendChild(div_pic);
            div_pic.appendChild(img)
            main_div.appendChild(div_msg);
            
        }
        
        $("#message-div").append(main_div);
        
    }
    
  });
  
  
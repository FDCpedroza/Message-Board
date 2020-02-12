$(document).ready(function() {
    $('.message-input').on('keyup', function() {
      var empty = false;
  
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
        var formData = $(this).serialize();
        //get form action
        var formUrl = $(this).attr('action');
        
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
        $('.message-btn').attr('disabled', 'disabled');
            
        return false;
        
    });
var x = 10;
    
    $('#show-more-msg').click(function(e) {
        e.preventDefault();
        var formUrl = $(this).attr('href'),
            user = $(this).attr('data-user-id'),
            reciever = $(this).attr('data-reciever-id')
            post_per_page = 10 ,
            offset = x;
        
        var formData = {
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
                //console.log(res.data)
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
        var main_div = document.createElement('div');
        var div_msg = main_div.cloneNode();
        var div_pic = main_div.cloneNode();
        var img = document.createElement('img');
        var webroot_img_path = $('#show-more-msg').attr('data-path-to-img');
        var userMsgDivClass = [
            'message-div',
            'col-9',
            'alert',
            'alert-secondary',
            'offset-1'
        ];
        var recieverMsgDivClass = [
            'message-div',
            'col-9',
            'alert',
            'alert-primary'
        ];
        var data_link = $('#message-div .message-div')[0].getAttribute('data-link').replace(/\d+/g, '');
        var delete_link = $('#message-div .message-div')[0].getAttribute('data-delete-link').replace(/\d+/g, '');
        //console.log(delete_link)
        
        div_msg.setAttribute('msg-id', res.message.id)
        
        div_msg.setAttribute('msg-created', res.message.created)
        div_msg.setAttribute('data-link', data_link+res.message.id)
        div_msg.setAttribute('data-delete-link', delete_link+res.message.id)
        
        div_msg.textContent = res.message.content
        
        
        myAddClass(main_div, ['row'])
        main_div.setAttribute('id', 'msg-row-id-'+res.message.id)
        myAddClass(div_pic, ['col-2'])
        myAddClass(img, ['rounded-circle', 'user-pic'])
        
        if(res.message.from_id == user.id) {
            avatar = 'https://ui-avatars.com/api/?name=' + user.name;
            
            if(user.image){
                avatar = webroot_img_path + user.image
            }
            
            img.setAttribute('src', avatar);
        
            myAddClass(div_msg , userMsgDivClass);
            
            
            main_div.appendChild(div_msg);
            div_pic.appendChild(img)
            main_div.appendChild(div_pic);
            
            
        } else if(res.message.from_id == reciever.id) {
            avatar = 'https://ui-avatars.com/api/?name=' + reciever.name;
            
             
            if(reciever.image){
                avatar = webroot_img_path + reciever.image
            }
            img.setAttribute('src', avatar);
            
            myAddClass(div_msg , recieverMsgDivClass);
            main_div.appendChild(div_pic);
            div_pic.appendChild(img)
            main_div.appendChild(div_msg);
            
        }
        
        $("#message-div").append(main_div);
        
    }
    
    
    
        
 $(document.body).on('click', '.message-div', function(e) {
    // var data = '';
    var formUrl = e.target.getAttribute('data-link');
    var deleteUrl = e.target.getAttribute('data-delete-link');
    var parentId = $(this.parentNode).attr('id');
    var msg = '';
    
    $.ajax({
        type: 'POST',
        url: formUrl,
        async:false,
        success: function(res,textStatus,xhr){
            //data.push(res.message)
            msg = res.message
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
    // msg = data['0']
    console.log(msg)
    
    var p = confirm(
        'Message Details \n'+
        'Content: '+ msg.content+'\n'+
        'Created: '+msg.created+'\n\n\n'+
        'Press "OK" if you want to delete this message else press "CANCEL."'
        );
        
        if (p) {
            deleteMessage(deleteUrl,parentId);
        }
        
    
})
 
function deleteMessage(url, parentId) {
    
    $.ajax({
        type: 'POST',
        url: url,
        async:false,
        success: function(res,textStatus,xhr){
           if(res){
               $('#'+parentId).remove();
           }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
    
    
    
    
} 
 

 
    
  });
  
  
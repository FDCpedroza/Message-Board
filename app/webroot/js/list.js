$(document).ready(function() {
    var  i = 5,
        post_per_page = 5;
     
    $('#show-more-msg').click(function(e) {
        e.preventDefault();
        var formUrl = $(this).attr('href'),
            user = $(this).attr('data-user-id');
            
        var formData = {
            offset : i,
            count: post_per_page,
            user : user 
        }
            
        
        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(res,textStatus,xhr){
                i = i + post_per_page;
                console.log(res)
                
                if(res.length == 0) {
                    $('#show-more-msg').replaceWith('No more messages to show.');
                }
                
                $.each(res, function(i, val) {
                    //  console.log(val)
                    makeConvoDiv(val);
                    
                })
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
        
        
    })
    
    function makeConvoDiv (data) {
        //  console.log(data.chat_mate.image);return;
        var a = $('.list-group-item ')[0]
        path_to_user_convo = a.getAttribute('href');
        path_to_user_convo = path_to_user_convo.replace(/[0-9]/g, '')
        
        var webroot_img_path = $('#show-more-msg').attr('data-path-to-img');
        var achor = document.createElement('a');
        var main_div = document.createElement('div');
        var inside_main_div = main_div.cloneNode();
        var img_div = main_div.cloneNode();
        var img = document.createElement('img');
        var text_div = main_div.cloneNode();
        var name_div = main_div.cloneNode();
        var name_div2 = main_div.cloneNode();
        var msg_div = main_div.cloneNode();
        var msg_div2 = main_div.cloneNode();
        var date_div = main_div.cloneNode();
        var date_div2 = main_div.cloneNode();
        
        achor.setAttribute('class', 'list-group-item list-group-item-action');
        main_div.setAttribute('class', 'row');
        inside_main_div.setAttribute('class', 'col row');
        img_div.setAttribute('class', 'col-lg-2');
        img.setAttribute('class', 'rounded-circle list-img');
        text_div.setAttribute('class', 'col-lg-10');
        name_div.setAttribute('class', 'row');
        name_div2.setAttribute('class', 'row pl-4 text-capitalize font-weight-bold');
        msg_div.setAttribute('class', 'row');
        msg_div2.setAttribute('class', 'row pl-4 message-row');
        date_div.setAttribute('class', 'row');
        date_div2.setAttribute('class', 'row pl-4 text-monospace text-muted list-date')
        
        
        avatar = 'https://ui-avatars.com/api/?name=' + data.chat_mate.name;
        if(data.chat_mate.image){
            avatar = webroot_img_path + data.chat_mate.image
        }
        
        achor.setAttribute('href', path_to_user_convo+data.chat_mate.id);
        img.setAttribute('src', avatar);
        name_div2.textContent = data.chat_mate.name;
        msg_div2.textContent = data.latest_chat.content
        date_div2.textContent = data.latest_chat.created
        
        
        
        achor.appendChild(main_div)
        main_div.appendChild(inside_main_div)
        
        inside_main_div.appendChild(img_div)
        inside_main_div.appendChild(text_div)
        
        img_div.appendChild(img)
        
        text_div.appendChild(name_div)
        name_div.appendChild(name_div2)
        
        text_div.appendChild(msg_div)
        msg_div.appendChild(msg_div2)
        
        text_div.appendChild(date_div)
        date_div.appendChild(date_div2)
        
        $("#list-div").append(achor);
    }
    

 
    
    
    
});
  
  
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
                if(res.length == 0) {
                    $('#show-more-msg').replaceWith('No more messages to show.');
                }
                
                $.each(res, function(i, val) {
                    makeConvoDiv(val);
                })
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
    })
    
    function makeConvoDiv (data) {
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
    
    
    $('#search-input').keyup(function(e) {
        var data;
        var newDiv;
        var container = $("#list-div");
        if (e.keyCode === 13) {
            var formData = {
                searchWord : $(this).val(),
                user: $(this).attr('data-user-id')
            };
            var formUrl = $(this).attr('search-link');
            data = myAjax(formUrl,formData);
            // console.log(data);
            //check data.lengt before append
            if(data.length != 0) {
                $('#show-more-msg').css('display', 'none');
                console.log(data)
                $.each(data , function(i,val) {
                    newDiv =  cloneDiv(val)
                    if(i == 0) {
                        container.html(newDiv); //first loop deletes data and replace it with new div
                    }else{
                        container.append(newDiv); // appends data not delete
                    }
                })
            }
        }
        
    });
    
    
    $('#reset-btn').click(function(e) {
       console.log('reset') 
    });

    function myAjax(formUrl, formData = null) {
        var data; 
        
        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            async:false,
            success: function(res,textStatus,xhr){
                data = res; 
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
        
        return data; 
    }
    
    
    function cloneDiv(data) {
        var container = $('#list-div');
        var cloneDiv = $('#list-div a:first-child').clone();
        var webroot_img_path = $('#show-more-msg').attr('data-path-to-img');
        var userLink = $('.list-group-item ')[0].getAttribute('href').replace(/[0-9]/g, '');
        
        cloneDiv.attr('href', userLink+data.chat_mate.id);
        cloneDiv.find('#name-div').html(data.chat_mate.name);
        cloneDiv.find('#message-div').html(data.latest_chat.content);
        cloneDiv.find('#date-div').html(data.latest_chat.created);
        
        avatar = 'https://ui-avatars.com/api/?name=' + data.chat_mate.name;
        if(data.chat_mate.image){
            avatar = webroot_img_path + data.chat_mate.image;
        }
        cloneDiv.find('.rounded-circle')[0].setAttribute('src', avatar);
        return cloneDiv;
    }
    
    
    
});



  
// var cl = $('#list-div a:first-child')
// undefined
// cl = cl.clone()
// init [a.list-group-item.list-group-item-action, prevObject: init(1), context: document]
// cl.insertBefore('#list-div a:first-child')
// init [a.list-group-item.list-group-item-action, prevObject: init(1), context: document]
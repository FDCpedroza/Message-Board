$(document).ready(function() {
    var  i = 5;
    $('#show-more-msg').click(function(e) {
        e.preventDefault();
        let formURl = $(this).attr('href')
        
        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(res,textStatus,xhr){
                //
                x = offset + 10;
                // console.log(res.data)
                
                // if(res.data.length == 0) {
                //     $('#show-more-msg').replaceWith('No more messages to show.');
                // }
                
                // $.each(res.data, function(i, val) {
                //     // console.log(val)
                //     makeMsgDiv(val, res.user, res.reciever);
                // })
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
        
        
    })
});
  
  
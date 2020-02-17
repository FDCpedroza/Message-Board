$(document).ready(function() {
   
    var user_id;
    var empty, user_valid = false;
    $('.message-input').on('keyup', function() {
        $('.message-input').each(function() {
          empty = ($(this).val().length > 0 || $(this).val().length != '' );
        });
        enableBtn(user_valid, empty);
    });
      
      
    $('#MessageRecepient').change(function() {
      user_id = $('#MessageRecepient').find(':selected').val();
      user_valid = user_id >= 0 || user_id != '';
      enableBtn(user_valid, empty);
    })
    
    function enableBtn(user_valid, empty) {
      if (empty && user_valid)
        $('.message-btn').attr('disabled', false);
      else
        $('.message-btn').attr('disabled', 'disabled');
    }
    
    $('#MessageRecepient').select2({
      placeholder: "Search User",
    });
      
      
      
});



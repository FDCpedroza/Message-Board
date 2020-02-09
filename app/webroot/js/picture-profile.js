$('#upload-link').click(function(e){
    e.preventDefault();
    $('#UserUploadPic').trigger('click');
});

$("#UserUploadPic").change(function() {
    displayPicture(this);
    $('#upload-link').html('Change');
});

function displayPicture(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#user-avatar').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
}
  

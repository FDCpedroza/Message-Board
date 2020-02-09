$(document).ready(function() {
    
    if ($("#app-form").length > 0) {
        $("#app-form").validate({
            onkeyup: false,
            onclick: false,
            onfocusout: false,
            errorClass: 'text-danger',
            errorElement: 'span',
            
            rules: {
            'data[User][name]': {
                    required: true,
                    maxlength: 20,
                    minlength: 5
                },
            
                'data[User][email]': {
                    remote:{
                        url:"checkEmail/",
                        type:"get"
                    },
                    required: true,
                    maxlength: 50,
                    email: true,
                    
                },
                'data[User][password]':{
                        required: true,
                        minlength:6,
                        
                },
                'data[User][confirm_password]':{
                        required: true,
                        minlength:6,
                        equalTo: '#UserPassword'
                },
                
            },
            messages: {
            
                'data[User][name]': {
                    required: "Name is required",
                    maxlength: "Your last name maxlength should be 50 characters long.",
                    minlength: "The name should be 3 digits",
                },
            
                'data[User][email]': {
                    remote:'The email is already taken',
                    required: "Please enter valid email",
                    email: "Please enter valid email",
                    maxlength: "The email name should less than or equal to 50 characters",
                    
                },
                'data[User][password]':{
                    required: 'Please eneter password',
                    minlength: "The contact number should be 7 digits",
                        
                },
                'data[User][confirm_password]':{
                        required: 'Please eneter password',
                        minlength: "The contact number should be 7 digits",
                        equalTo: 'Password does not match'
                }
                
            },
            showErrors: function(errorMap, errorList) {
                // console.log(errorList)
                var messages = '';
                $.each( errorList, function( i, val ) {
                    messages = messages + "<li>" + errorList[i].message + "</li>";
                });
                
                if(messages.length != 0) {
                    $("#error").html(messages);
                    $("#error").css({'display': 'block'});
                }
            },
            submitHandler: function(form) { // <- pass 'form' argument in
                $("#submit").attr("disabled", true);
                form.submit(); // <- use 'form' argument here.
            } 
        })
    }

})
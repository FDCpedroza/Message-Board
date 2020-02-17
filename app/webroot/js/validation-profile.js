if ($("#editUserForm").length > 0) {
    $("#editUserForm").validate({
        onkeyup: false,
        onclick: false,
        onfocusout: false,
    errorClass: 'text-danger',
    errorElement: 'span',
    
    rules: {
        // 'data[User][Upload Pic]':{
           //required: true,
           //extension: "jpg|gif|png"
        // },
       'data[User][name]': {
            required: true,
            maxlength: 20,
            minlength: 5
        },
        'data[User][email]': {
            required: true,
            maxlength: 50,
            email: true,
            remote:{
                    url:"checkEmail/",
                    type:"get"
                }
        },
        'data[User][date]':{
            required: true
        },
        'data[User][gender]':{
            required: true
        },
        'data[User][hubby]':{
            required: true
        }
        
       
        
    },
    messages: {
        'data[User][Upload Pic]':{
            //required: 'Picture is required.',
            extension: "File should be jpg, gif or png only."
         },
    
        'data[User][name]': {
            required: "Name is required",
            maxlength: "Your last name maxlength should be 20 characters long.",
            minlength: "The name should be 5 digits",
        },
       
        'data[User][email]': {
            required: "Please enter valid email",
            email: "Please enter valid email",
            maxlength: "The email name should less than or equal to 50 characters",
            remote:'The email is already taken'
        },
        'data[User][date]':{
            required: 'Please enter birthdate.'
        },
        'data[User][gender]':{
            required: 'Please select gender.'
        },
        'data[User][hubby]':{
            required: "Please fill up hubby feild."
        }
            
    },
    showErrors: function(errorMap, errorList) {
        console.log(errorList)
        var messages = '';
        $.each( errorList, function( i, val ) {
            messages = messages + "<li>" + errorList[i].message + "</li>";
        });
        $("#summary").html(messages);
        
    },
    submitHandler: function(form) { // <- pass 'form' argument in
        $("#submit").attr("disabled", true);
        form.submit(); // <- use 'form' argument here.
    }
   
    
    })
}
$(document).ready(function () {

    $("#addUserForm").submit(function (e) {

        //stop submitting the form to see the disabled button effect
        e.preventDefault();

        //disable the submit button
        
        if($('#error').children().length < 0) {
            $("#form-submit").attr("disabled", true);
        }

        return true;
    });
});
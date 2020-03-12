var notyf=new Notyf();

$('#body').hide();
$('#body').fadeIn(1500);
//$('#flashMessage').fadeIn(3000);

let username_flag_add=0;
let pass_flag_add=0;
let email_flag_add=0;
let fullname_flag_add=0;




// $('#Edit-members').hide();
//  $('#Edit-members').fadeIn(2000);

//
// $('.submit-btn').click(function(event){
//  event.preventDefault();
//  $('#flashMessage').fadeIn(1000);
//  $('#flashMessage').fadeOut(2000)
//});
function looksLikeMail(str) {
    var lastAtPos = str.lastIndexOf('@');
    var lastDotPos = str.lastIndexOf('.');
    return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
}


// notyf.alert('You must fill out the form before moving forward');
// notyf.confirm('Your changes have been successfully saved!');




//function to validate submitting only Correct inputs from The user otherwise no submission.

/* Handling Username input */
$('#usernameadd').blur(function(){
    let username=document.getElementById('usernameadd').value;
    if(!isNaN(username)){
        $("#usernameadd").addClass('form-error');
        $("#usernameadd").removeClass('form-success');
        username_flag_add=0;
       // notyf.alert("Error");
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#usernameadd").addClass('form-success');
        $("#usernameadd").removeClass('form-error');
        //notyf.confirm("Success");
        username_flag_add=1;
       }
 });
/*End of Handling username input */

/* Start of Handling Email */
    $('#emailadd').blur(function(){
        let email=document.getElementById('emailadd').value;
        if(looksLikeMail(email)){
            $("#emailadd").addClass('form-success');
            $("#emailadd").removeClass('form-error');
            email_flag_add=1;
           }

           else if(!looksLikeMail(email)){
            $("#emailadd").addClass('form-error');
            $("#emailadd").removeClass('form-success');
            email_flag_add=0;
           }
           });
   /* End of Handling Email */

     /* Start of Handling password*/
     $('#passwordadd').blur(function(){
        let password=document.getElementById('passwordadd').value;
        if(password==""){
            $("#passwordadd").addClass('form-error');
            $("#passwordadd").removeClass('form-success');
            pass_flag_add=0;
        }
        else{
            $("#passwordadd").addClass('form-success');
            $("#passwordadd").removeClass('form-error');
            pass_flag_add=1;
           }
     });
      /* End of Handling password*/

      /* Start of Handling Full Name*/
      $('#fullnameadd').blur(function(){
        let fullname=document.getElementById('fullnameadd').value;
        if(!isNaN(fullname)){
            $("#fullnameadd").addClass('form-error');
            $("#fullnameadd").removeClass('form-success');
            fullname_flag_add=0;
           // notyf.alert("Error");
           // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
        }
        else{
            $("#fullnameadd").addClass('form-success');
            $("#fullnameadd").removeClass('form-error');
            //notyf.confirm("Success");
            fullname_flag_add=1;
           }
        });
  /* End of Handling Full Name*/

  $('#submit-btn1add').click(function(event){
    let username=document.getElementById('usernameadd').value;
    let email=document.getElementById('emailadd').value;
    let password=document.getElementById('passwordadd').value;
    let fullname=document.getElementById('fullnameadd').value;
    if((username_flag_add==0)&&(username==""))
    {
        notyf.alert("Please Enter Your Username");
        event.preventDefault();


    }
    if((username_flag_add==0)&&(username!=""))
    {
        notyf.alert("Invalid Username");
        event.preventDefault();
    }

    if(pass_flag_add==0)
    {
        notyf.alert("Please Enter Your Password");
        event.preventDefault();
    }

    if((email_flag_add==0)&&(email==""))
    {
        notyf.alert("Please Enter Your email");
        event.preventDefault();


    }
    if((email_flag_add==0)&&(email!=""))
    {
        notyf.alert("Invalid email Please Try Again");
        event.preventDefault();
    }
    if((fullname_flag_add==0)&&(fullname==""))
    {
        notyf.alert("Please Enter Your Name");
        event.preventDefault();


    }
    if((fullname_flag_add==0)&&(fullname!=""))
    {
        notyf.alert("Invalid Name Please Try Again");
        event.preventDefault();
    }


    if((username_flag_add==1)&&(pass_flag_add==1)&&(fullname_flag_add==1)&&(email_flag_add==1)){
     notyf.confirm("You Are All done ");

 }
  });

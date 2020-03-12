




var notyf=new Notyf();
$('#body').hide();
$('#body').fadeIn(1500);
//$('#flashMessage').fadeIn(3000);

let username_flag=0;
let pass_flag=0;
let email_flag=0;
let fullname_flag=0;




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
$('#username').blur(function(){
    let username=document.getElementById('username').value;
    alert(username);
    
    // if(!isNaN(username)){
    //     $("input[id='username']").addClass('form-error');
    //     $("input[id='username']").removeClass('form-success');
    //     username_flag=0;
    // }
    // else{
    //     $("input[id='username']").addClass('form-success');
    //     $("input[id='username']").removeClass('form-error');
    //     //notyf.confirm("Success");
    //     username_flag=1;
    //    }
 });
/*End of Handling username input */

/* Start of Handling Email */
    $('#email').blur(function(){
        let email=document.getElementById('email').value;
        if(looksLikeMail(email)){
            $("input[id='email']").addClass('form-success');
            $("input[id='email']").removeClass('form-error');
            email_flag=1;
           }
          
           else if(!looksLikeMail(email)){
            $("input[id='email']").addClass('form-error');
            $("input[id='email']").removeClass('form-success');
            email_flag=0;
           }
           });
   /* End of Handling Email */

     /* Start of Handling password*/ 
     $('#password').blur(function(){
        let password=document.getElementById('password').value;
        if(password==""){
            $("input[id='password']").addClass('form-error');
            $("input[id='password']").removeClass('form-success');
            pass_flag=0;
        }
        else{
            $("input[id='password']").addClass('form-success');
            $("input[id='password']").removeClass('form-error');
            pass_flag=1;
           }
     });
      /* End of Handling password*/ 

      /* Start of Handling Full Name*/ 
      $('#fullname').blur(function(){
        let fullname=document.getElementById('fullname').value;
        if(!isNaN(fullname)){
            $("input[id='fullname']").addClass('form-error');
            $("input[id='fullname']").removeClass('form-success');
            fullname_flag=0;
           // notyf.alert("Error");
           // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
        }
        else{
            $("input[id='fullname']").addClass('form-success');
            $("input[id='fullname']").removeClass('form-error');
            //notyf.confirm("Success");
            fullname_flag=1;
           }
        });
  /* End of Handling Full Name*/ 

  $('#submit-btn').click(function(event){
    let username=document.getElementById('username').value;
    let email=document.getElementById('email').value;
    let password=document.getElementById('password').value;
    let fullname=document.getElementById('fullname').value;
    if((username_flag==0)&&(username==""))
    {
        notyf.alert("Please Enter Your Username");
        event.preventDefault();
 
 
    }
    if((username_flag==0)&&(username!=""))
    {
        notyf.alert("Invalid Username");
        event.preventDefault();
    }
 
    if(pass_flag==0)
    {
        notyf.alert("Please Enter Your Password");
        event.preventDefault();
    }

    if((email_flag==0)&&(email==""))
    {
        notyf.alert("Please Enter Your email");
        event.preventDefault();
 
 
    }
    if((email_flag==0)&&(email!=""))
    {
        notyf.alert("Invalid email Please Try Again");
        event.preventDefault();
    }
    if((fullname_flag==0)&&(fullname==""))
    {
        notyf.alert("Please Enter Your Name");
        event.preventDefault();
 
 
    }
    if((fullname_flag==0)&&(fullname!=""))
    {
        notyf.alert("Invalid Name Please Try Again");
        event.preventDefault();
    }


    if((username_flag==1)&&(pass_flag==1)&&(fullname_flag==1)&&(email_flag==1)){
     notyf.confirm("You Are All done ")
     event.preventDefault();
 
 }
  });




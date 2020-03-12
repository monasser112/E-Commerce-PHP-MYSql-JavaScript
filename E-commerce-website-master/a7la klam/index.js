
let username_flag=0;
let pass_flag=0;


var notyf=new Notyf();
$('#username').blur(function(){
    let username=document.getElementById('username').value;
    if(!isNaN(username)){
        $("input[id='username']").addClass('form-error');
        $("input[id='username']").removeClass('form-success');
        username_flag=0;
       // notyf.alert("Error");
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("input[id='username']").addClass('form-success');
        $("input[id='username']").removeClass('form-error');
        //notyf.confirm("Success");
        username_flag=1;
       }
 });


 $('#password').blur(function(){
    let password=document.getElementById('password').value;
    if(password==""){
        $("input[id='password']").addClass('form-error');
        $("input[id='password']").removeClass('form-success');
      //  notyf.alert("fail");
        pass_flag=0;
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("input[id='password']").addClass('form-success');
        $("input[id='password']").removeClass('form-error');
       // notyf.confirm("success");
        pass_flag=1;
       }
 });


 $('#submit-btn').click(function(event){
    let username=document.getElementById('username').value;
    let password=document.getElementById('password').value;

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
   if((username_flag==1)&&(pass_flag==1)){
    notyf.confirm("You Are All done ")
    event.preventDefault();

}
 });
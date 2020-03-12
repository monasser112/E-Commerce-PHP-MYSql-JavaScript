var notyf=new Notyf();
notyf.confirm("a7la klam");
let comment_flag=0;
$('#comment').blur(function(){
    let comment=document.getElementById('comment').value;
    if(!isNaN(comment)){
        $("textarea[id='comment']").addClass('form-error');
        $("textarea[id='comment']").removeClass('form-success');
        comment_flag=0;
    }
    else{
        $("textarea[id='comment']").addClass('form-success');
        $("textarea[id='comment']").removeClass('form-error');
        comment_flag=1;
      //  $("#name-msg").html(" ");

    }
});


$('#submit-btn').click(function(event){
let comment=document.getElementById('comment').value;

    if ((comment_flag==0)&&(comment!="")){
     notyf.alert("Invalid comment Please Try Again");
        event.preventDefault();
    }


    if ((comment_flag==0)&&(comment=="")){
        notyf.alert("You cant Leave it Empty Please Try Again");
           event.preventDefault();
       }


});
// function looksLikeMail(str) {
//     var lastAtPos = str.lastIndexOf('@');
//     var lastDotPos = str.lastIndexOf('.');
//     return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
// }
let nameFlag=0;
let descFlag=0;
let priceFlag=0;
let countryFlag=0;
let statusFlag_1=0;
let statusFlag_2=0;

var notyf = new Notyf();


$('#name').blur(function(){
    let name=document.getElementById('name').value;
    if(!isNaN(name)){
       // notyf.confirm('You have Succefully Entered Your Email!');
        $("input[id='name']").addClass('form-error');
        $("input[id='name']").removeClass('form-success');
        nameFlag=0;
       // $('#flashMessage').css("background-color","#64ce83");
    }
    else{
      //  notyf.alert("Error");
        $("input[id='name']").addClass('form-success');
        $("input[id='name']").removeClass('form-error');
        nameFlag=1;
    }
    $('#name').val('');
  // alert(($('.card-title').text()));
});


 


$('#desc').blur(function(){
    let desc=document.getElementById('desc').value;
    if(!isNaN(desc)){
        $("input[id='desc']").addClass('form-error');
        $("input[id='desc']").removeClass('form-success');
        descFlag=0;
      //  descFlag=0;
        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);

       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("input[id='desc']").addClass('form-success');
        $("input[id='desc']").removeClass('form-error');
        descFlag=1;
      //  descFlag=1;
      //  $("#name-msg").html(" ");

    }
    $('#desc').val('');
});


$('#price').blur(function(){
    let price=document.getElementById('price').value;
    if((price.indexOf('$')>-1)||!(isNaN(price)))
    {
        $("input[id='price']").addClass('form-success');
        $("input[id='price']").removeClass('form-error');
        priceFlag=1;
    }
    // if(price.length==0)
    // {
    //     $("input[id='price']").addClass('form-error');
    //     $("input[id='price']").removeClass('form-success');
    //     priceFlag=0;
    // }

    // if(isNaN(price)||price==''){
    //     $("input[id='price']").addClass('form-error');
    //     $("input[id='price']").removeClass('form-success');
    //     priceFlag=0;

    //   // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    // }
     if($('#price').val().length==0){
        $("input[id='price']").addClass('form-error');
        $("input[id='price']").removeClass('form-success');
        priceFlag=0;

      //  $("#name-msg").html(" ");

    }
});


$('#country').blur(function(){
    let country=document.getElementById('country').value;
    if(!isNaN(country)){
        $("input[id='country']").addClass('form-error');
        $("input[id='country']").removeClass('form-success');
        countryFlag=0;

        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);

       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("input[id='country']").addClass('form-success');
        $("input[id='country']").removeClass('form-error');
        countryFlag=1;
      //  $("#name-msg").html(" ");

    }
});

$('#status1').blur(function(){
    let status1=document.getElementById('status1').value;
    //var selected_option = $('#status option:selected').val();
       if(status1=="Open this select menu"){
        $("select[id='status1']").addClass('form-error');
        $("select[id='status1']").removeClass('form-success');
        statusFlag_1=0;
       }
       if(status1!="Open this select menu"){
        $("select[id='status1']").addClass('form-success');
        $("select[id='status1']").removeClass('form-error');
        statusFlag_1=1;
       }
});

$('#status2').blur(function(){
    let status2=document.getElementById('status2').value;
    //var selected_option = $('#status option:selected').val();
       if(status2=="Open this select menu"){
        $("select[id='status2']").addClass('form-error');
        $("select[id='status2']").removeClass('form-success');
        statusFlag_2=0;
       }
       if(status2!="Open this select menu"){
        $("select[id='status2']").addClass('form-success');
        $("select[id='status2']").removeClass('form-error');
        statusFlag_2=1;
       }
});






$('.live-name').keyup(function(){

   $('.live-preview .card-body h3').text($(this).val());
     //console.log($(this).val());
});


$('.live-desc').keyup(function(){

    $('.live-preview .card-body p').text($(this).val());
     // console.log($(this).val());
 });

 $('.live-price').keyup(function(){

    $('.live-preview .price-tag').text('$'+$(this).val());
     // console.log($(this).val());
 });




$('#submit-btn').click(function(event){
    // let email=document.getElementById('email').value;
    // let desc=document.getElementById('desc').value;
    // let price=document.getElementById('price').value;
    // let country=document.getElementById('country').value;

    if(nameFlag==0){
        notyf.alert("Invalid Email Please Try Again");
        event.preventDefault();
    }
    if(descFlag==0){
        notyf.alert("Invalid Description Please Try Again");
        event.preventDefault();
    }
    if(priceFlag==0){
        notyf.alert("Invalid Price Please Try Again");
        event.preventDefault();
    }
    if(countryFlag==0){
        notyf.alert("Please Enter a valid Country");
        event.preventDefault();
    }

    if(statusFlag_1==0){
        notyf.alert("Please Select a Valid Status");
        event.preventDefault();
    }
    if(statusFlag_2==0){
        notyf.alert("Please Enter a valid Status");
        event.preventDefault();
    }





    if((nameFlag==1)&&(descFlag==1)&&(priceFlag==1)&&(countryFlag==1)&&(statusFlag_1=1)&&(statusFlag_2=1)){
        notyf.confirm("We are Done");
        event.preventDefault();
    }
});

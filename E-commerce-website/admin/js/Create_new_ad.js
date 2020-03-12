// function looksLikeMail(str) {
//     var lastAtPos = str.lastIndexOf('@');
//     var lastDotPos = str.lastIndexOf('.');
//     return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
// }
let nameFlag_ad=0;
let descFlag_ad=0;
let priceFlag_ad=0;
let countryFlag_ad=0;
let statusFlag_1_ad=0;
let statusFlag_2_ad=0;

var notyf = new Notyf();


$('#name_ad').blur(function(){
    let name=document.getElementById('name_ad').value;
    if(!isNaN(name)){
       // notyf.confirm('You have Succefully Entered Your Email!');
        $("#name_ad").addClass('form-error');
        $("#name_ad").removeClass('form-success');
        nameFlag_ad=0;
       // $('#flashMessage').css("background-color","#64ce83");
    }
    else{
      //  notyf.alert("Error");
        $("#name_ad").addClass('form-success');
        $("#name_ad").removeClass('form-error');
        nameFlag_ad=1;
    }
    $('#name_ad').val('');
  // alert(($('.card-title').text()));
});


 


$('#desc_ad').blur(function(){
    let desc=document.getElementById('desc_ad').value;
    if(!isNaN(desc)){
        $("#desc_ad").addClass('form-error');
        $("#desc_ad").removeClass('form-success');
        descFlag_ad=0;
      //  descFlag=0;
        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);

       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#desc_ad").addClass('form-success');
        $("#desc_ad").removeClass('form-error');
        descFlag_ad=1;
      //  descFlag=1;
      //  $("#name-msg").html(" ");

    }
    $('#desc_ad').val('');
});


$('#price_ad').blur(function(){
    let price=document.getElementById('price_ad').value;
    if((price.indexOf('$')>-1)||!(isNaN(price)))
    {
        $("#price_ad").addClass('form-success');
        $("#price_ad").removeClass('form-error');
        priceFlag_ad=1;
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
     if($('#price_ad').val().length==0){
        $("#price_ad").addClass('form-error');
        $("#price_ad").removeClass('form-success');
        priceFlag_ad=0;

      //  $("#name-msg").html(" ");

    }
});


$('#country_ad').blur(function(){
    let country=document.getElementById('country_ad').value;
    if(!isNaN(country)){
        $("#country_ad").addClass('form-error');
        $("#country_ad").removeClass('form-success');
        countryFlag_ad=0;

        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);

       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#country_ad").addClass('form-success');
        $("#country_ad").removeClass('form-error');
        countryFlag_ad=1;
      //  $("#name-msg").html(" ");

    }
});

$('#status1_ad').blur(function(){
    let status1=document.getElementById('status1_ad').value;
    //var selected_option = $('#status option:selected').val();
       if(status1=="Open this select menu"){
        $("#status1_ad").addClass('form-error');
        $("#status1_ad").removeClass('form-success');
        statusFlag_1_ad=0;
       }
       if(status1!="Open this select menu"){
        $("#status1_ad").addClass('form-success');
        $("#status1_ad").removeClass('form-error');
        statusFlag_1_ad=1;
       }
});

$('#status2_ad').blur(function(){
    let status2=document.getElementById('status2_ad').value;
    //var selected_option = $('#status option:selected').val();
       if(status2=="Open this select menu"){
        $("#status2_ad").addClass('form-error');
        $("#status2_ad").removeClass('form-success');
        statusFlag_2_ad=0;
       }
       if(status2!="Open this select menu"){
        $("#status2_ad").addClass('form-success');
        $("#status2_ad").removeClass('form-error');
        statusFlag_2_ad=1;
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

    if(nameFlag_ad==0){
        notyf.alert("Invalid Email Please Try Again");
        event.preventDefault();
    }
    if(descFlag_ad==0){
        notyf.alert("Invalid Description Please Try Again");
        event.preventDefault();
    }
    if(priceFlag_ad==0){
        notyf.alert("Invalid Price Please Try Again");
        event.preventDefault();
    }
    if(countryFlag_ad==0){
        notyf.alert("Please Enter a valid Country");
        event.preventDefault();
    }

    if(statusFlag_1_ad==0){
        notyf.alert("Please Select a Valid Status");
        event.preventDefault();
    }
    if(statusFlag_2_ad==0){
        notyf.alert("Please Enter a valid Status");
        event.preventDefault();
    }





    if((nameFlag_ad==1)&&(descFlag_ad==1)&&(priceFlag_ad==1)&&(countryFlag_ad==1)&&(statusFlag_1_ad=1)&&(statusFlag_2_ad=1)){
        notyf.confirm("We are Done");
        event.preventDefault();
    }
});

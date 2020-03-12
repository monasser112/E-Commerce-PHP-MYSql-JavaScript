var notyf=new Notyf();

let itemFlag=0;
let descFlag=0;
let priceFlag=0;
let countryFlag=0;
let statusFlag=0;


$('#item').blur(function(){
    let item=document.getElementById('item').value;
    if(!isNaN(item)){
        $("input[id='item']").addClass('form-error');
        $("input[id='item']").removeClass('form-success');
        itemFlag=0;
    }
    else{
        $("input[id='item']").addClass('form-success');
        $("input[id='item']").removeClass('form-error');
        itemFlag=1;
    }
});

$('#desc').blur(function(){
    let desc=document.getElementById('desc').value;
    if(!isNaN(desc)){
        $("input[id='desc']").addClass('form-error');
        $("input[id='desc']").removeClass('form-success');
        descFlag=0;
        
    }
    else{
        $("input[id='desc']").addClass('form-success');
        $("input[id='desc']").removeClass('form-error');
        descFlag=1;
    }
});


$('#price').blur(function(){
    let price=document.getElementById('price').value;
    if((price.indexOf('$')>-1)||!(isNaN(price)))
    {
        $("input[id='price']").addClass('form-success');
        $("input[id='price']").removeClass('form-error');
        priceFlag=1;
    }
   
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

$('#status').blur(function(){
    let status=document.getElementById('status').value;
    //var selected_option = $('#status option:selected').val();
       if(status=="Open this select menu"){
        $("select[id='status']").addClass('form-error');
        $("select[id='status']").removeClass('form-success');
        statusFlag=0;
       }
       if(status!="Open this select menu"){
        $("select[id='status']").addClass('form-success');
        $("select[id='status']").removeClass('form-error');
        statusFlag=1;
       }
});


$('#submit-btn').click(function(event){
    let country=document.getElementById('country').value;
    let desc=document.getElementById('desc').value;
    let price=document.getElementById('price').value;
    let status=document.getElementById('status').value;
    
    if(descFlag==0){
        notyf.alert("Invalid Description Please Try Again");
        event.preventDefault();
    }
    if(statusFlag==0){
        notyf.alert("Invalid Status Please Try Again");
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
    if(itemFlag==0){
        notyf.alert("Please Enter a valid item name");
        event.preventDefault();
    }
    
    

    if((statusFlag==1)&&(descFlag==1)&&(priceFlag==1)&&(countryFlag==1)&&(itemFlag=1)){
        notyf.confirm("We are Done");
        event.preventDefault();
    }
     


});
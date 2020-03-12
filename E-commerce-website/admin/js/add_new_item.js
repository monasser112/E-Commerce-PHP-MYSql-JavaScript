var notyf=new Notyf();

let itemFlag_add=0;
let descFlag_add=0;
let priceFlag_add=0;
let countryFlag_add=0;
let statusFlag_add=0;


$('#item_add').blur(function(){
    let item=document.getElementById('item_add').value;
    if(!isNaN(item)){
        $("#item_add").addClass('form-error');
        $("#item_add").removeClass('form-success');
        itemFlag_add=0;
    }
    else{
        $("#item_add").addClass('form-success');
        $("#item_add").removeClass('form-error');
        itemFlag_add=1;
    }
});

$('#desc_add').blur(function(){
    let desc=document.getElementById('desc_add').value;
    if(!isNaN(desc)){
        $("#desc_add").addClass('form-error');
        $("#desc_add").removeClass('form-success');
        descFlag_add=0;

    }
    else{
        $("#desc_add").addClass('form-success');
        $("#desc_add").removeClass('form-error');
        descFlag_add=1;
    }
});




('#price_add').blur(function(){
    let price=document.getElementById('price_add').value;
    if((price.indexOf('$')>-1)||!(isNaN(price)))
    {
        $("#price_add").addClass('form-success');
        $("#price_add").removeClass('form-error');
        priceFlag_add=1;
    }

     if($('#price').val().length==0){
        $("#price_add").addClass('form-error');
        $("#price_add").removeClass('form-success');
        priceFlag_add=0;

      //  $("#name-msg").html(" ");

    }
});


$('#country_add').blur(function(){
    let country=document.getElementById('country_add').value;
    if(!isNaN(country)){
        $("#country_add").addClass('form-error');
        $("#country_add").removeClass('form-success');
        countryFlag_add=0;

        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);

       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#country_add").addClass('form-success');
        $("#country_add").removeClass('form-error');
        countryFlag_add=1;
      //  $("#name-msg").html(" ");

    }
});

$('#status_add').blur(function(){
    let status=document.getElementById('status_add').value;
    //var selected_option = $('#status option:selected').val();
       if(status=="Open this select menu"){
        $("#status_add").addClass('form-error');
        $("#status_add").removeClass('form-success');
        statusFlag_add=0;
       }
       if(status!="Open this select menu"){
        $("#status_add").addClass('form-success');
        $("#status_add").removeClass('form-error');
        statusFlag_add=1;
       }
});


$('#submit-btn-add-item').click(function(event){
    let country=document.getElementById('country_add').value;
    let desc=document.getElementById('desc_add').value;
    let price=document.getElementById('price_add').value;
    let status=document.getElementById('status_add').value;

    if(descFlag_add==0){
        notyf.alert("Invalid Description Please Try Again");
        event.preventDefault();
    }
    if(statusFlag_add==0){
        notyf.alert("Invalid Status Please Try Again");
        event.preventDefault();
    }
    if(priceFlag_add==0){
        notyf.alert("Invalid Price Please Try Again");
        event.preventDefault();
    }
    if(countryFlag_add==0){
        notyf.alert("Please Enter a valid Country");
        event.preventDefault();
    }
    if(itemFlag_add==0){
        notyf.alert("Please Enter a valid item name");
        event.preventDefault();
    }



    if((statusFlag_add==1)&&(descFlag_add==1)&&(priceFlag_add==1)&&(countryFlag_add==1)&&(itemFlag_add=1)){
        notyf.confirm("We are Done");
        event.preventDefault();
    }



});

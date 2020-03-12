// function allLetter(inputtxt){
// //    var letters = /^[A-Za-z]+$/;
//    var regex=/[^a-z]/gi;
//    if(inputtxt.match(letters))
//      {
//       return true;
//      }
//    else
//      {
//      return false;
//      }
//   }
let nameFlag_cat=0;
let descFlag_cat=0;
let orderFlag_cat=0;
var notyf = new Notyf();
$('#name_cat').blur(function(){
    let name=document.getElementById('name_cat').value;

    if(!isNaN(name)){
        $("#name_cat").addClass('form-error');
        $("#name_cat").removeClass('form-success');
        nameFlag_cat=0;
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#name_cat").addClass('form-success');
        $("#name_cat").removeClass('form-error');
        nameFlag_cat=1;
      //  $("#name-msg").html(" ");

    }
});

$('#desc_cat').blur(function(){
    let desc=document.getElementById('desc_cat').value;
    if(!isNaN(desc)){
        $("#desc_cat").addClass('form-error');
        $("#desc_cat").removeClass('form-success');
        descFlag_cat=0;
        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);

       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#desc_cat").addClass('form-success');
        $("#desc_cat").removeClass('form-error');
        descFlag_cat=1;
      //  $("#name-msg").html(" ");

    }
});

$('#order_cat').blur(function(){
    let order=document.getElementById('order_cat').value;
    if(isNaN(order)||order==''){
        $("#order_cat").addClass('form-error');
        $("#order_cat").removeClass('form-success');
        orderFlag_cat=0;
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#order_cat").addClass('form-success');
        $("#order_cat").removeClass('form-error');
        orderFlag_cat=1;
      //  $("#name-msg").html(" ");

    }
});

  $('#submit-btn-cat').click(function(event){
      if (nameFlag_cat==0){
       notyf.alert("Please Enter a Valid Category Name");
          event.preventDefault();
      }
      if (descFlag_cat==0){
        notyf.alert("Please Enter a Valid Description");
           event.preventDefault();
       }
       if (orderFlag_cat==0){
        notyf.alert("Please Enter a Valid Order Number");
           event.preventDefault();
       }

       if((nameFlag_cat==1)&&(descFlag_cat==1)&&(orderFlag_cat==1)){
           notyf.confirm("You Are All done ");
          
       }


//  let name=document.getElementById('name').value;
//  let desc=document.getElementById('description').value;
//  let order=document.getElementById('order').value;
//  if(!allLetter(name))
//  {


  });

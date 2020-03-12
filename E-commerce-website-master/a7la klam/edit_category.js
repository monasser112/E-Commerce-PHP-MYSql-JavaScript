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
let nameFlag=0;
let descFlag=0;
let orderFlag=0;
var notyf = new Notyf();
$('#name').blur(function(){
    let name=document.getElementById('name').value;
   
    if(!isNaN(name)){
        $("input[id='name']").addClass('form-error');
        $("input[id='name']").removeClass('form-success');
        nameFlag=0;
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("input[id='name']").addClass('form-success');
        $("input[id='name']").removeClass('form-error');
        nameFlag=1;
      //  $("#name-msg").html(" ");

    }
});

$('#desc').blur(function(){
    let desc=document.getElementById('desc').value;
    if(!isNaN(desc)){
        $("input[id='desc']").addClass('form-error');
        $("input[id='desc']").removeClass('form-success');
        descFlag=0;
        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);
       
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("input[id='desc']").addClass('form-success');
        $("input[id='desc']").removeClass('form-error');
        descFlag=1;
      //  $("#name-msg").html(" ");

    }
});

$('#order').blur(function(){
    let order=document.getElementById('order').value;
    if(isNaN(order)||order==''){
        $("input[id='order']").addClass('form-error');
        $("input[id='order']").removeClass('form-success');
        orderFlag=0;
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("input[id='order']").addClass('form-success');
        $("input[id='order']").removeClass('form-error');
        orderFlag=1;
      //  $("#name-msg").html(" ");

    }
});





 
 

 
  $('#submit-btn').click(function(event){

      if (nameFlag==0){
       notyf.alert("Please Enter a Valid Category Name");
          event.preventDefault();
      }
      if (descFlag==0){
        notyf.alert("Please Enter a Valid Description");
           event.preventDefault();
       }
       if (orderFlag==0){
        notyf.alert("Please Enter a Valid Order Number");
           event.preventDefault();
       }

       if(!$('.visible').is(':checked')){
        // visible_flag=1;
        // $("label[id='visible']").addClass('form-error');
        // $("label[id='visible']").removeClass('form-success');
        notyf.alert("Please Choose an Option From those Listed");
        event.preventDefault();
       }
       if(!$('.comment').is(':checked')){
        notyf.alert("Please Choose an Option From those Listed");
        event.preventDefault();
     }
     if(!$('.ad').is(':checked')){
         notyf.alert("Please Choose an Option From those Listed");
         event.preventDefault();
     }
       if((nameFlag==1)&&(descFlag==1)&&(orderFlag==1)&&($('.visible').is(':checked'))&&($('.comment').is(':checked'))&&($('.ad').is(':checked'))){
           notyf.confirm("You Are All done ")
           event.preventDefault();

       }
       
     
//  let name=document.getElementById('name').value;
//  let desc=document.getElementById('description').value;
//  let order=document.getElementById('order').value;
//  if(!allLetter(name))
//  {
    
 
  });


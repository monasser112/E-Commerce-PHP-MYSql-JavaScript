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
let nameFlag_edit_cat=0;
let descFlag_edit_cat=0;
let orderFlag_edit_cat=0;
var notyf = new Notyf();
$('#name_edit_cat').blur(function(){
    let name=document.getElementById('name_edit_cat').value;

    if(!isNaN(name)){
        $("#name_edit_cat").addClass('form-error');
        $("#name_edit_cat").removeClass('form-success');
        nameFlag_edit_cat=0;
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#name_edit_cat").addClass('form-success');
        $("#name_edit_cat").removeClass('form-error');
        nameFlag_edit_cat=1;
      //  $("#name-msg").html(" ");

    }
});

$('#desc_edit_cat').blur(function(){
    let desc=document.getElementById('desc_edit_cat').value;
    if(!isNaN(desc)){
        $("#desc_edit_cat").addClass('form-error');
        $("#desc_edit_cat").removeClass('form-success');
        descFlag_edit_cat=0;
        // $('#flashMessage').html("Please Enter The UserName !").css("background-color","red")
        // .fadeIn(2500).fadeOut(1000);

       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#desc_edit_cat").addClass('form-success');
        $("#desc_edit_cat").removeClass('form-error');
        descFlag_edit_cat=1;
      //  $("#name-msg").html(" ");

    }
});

$('#order_edit_cat').blur(function(){
    let order=document.getElementById('order_edit_cat').value;
    if(isNaN(order)||order==''){
        $("#order_edit_cat").addClass('form-error');
        $("#order_edit_cat").removeClass('form-success');
        orderFlag_edit_cat=0;
       // $("#name-msg").html("<p>Please Enter a Valid name !</p>").css("color","red");
    }
    else{
        $("#order_edit_cat").addClass('form-success');
        $("#order_edit_cat").removeClass('form-error');
        orderFlag_edit_cat=1;
      //  $("#name-msg").html(" ");

    }
});









  $('#submit-btn-edit-cat').click(function(event){

      if (nameFlag_edit_cat==0){
       notyf.alert("Please Enter a Valid Category Name");
          event.preventDefault();
      }
      if (descFlag_edit_cat==0){
        notyf.alert("Please Enter a Valid Description");
           event.preventDefault();
       }
       if (orderFlag_edit_cat==0){
        notyf.alert("Please Enter a Valid Order Number");
           event.preventDefault();
       }

       if(!$('.visible_edit_cat').is(':checked')){
        // visible_flag=1;
        // $("label[id='visible']").addClass('form-error');
        // $("label[id='visible']").removeClass('form-success');
        notyf.alert("Please Choose an Option From those Listed");
        event.preventDefault();
       }
       if(!$('.comment_edit_cat').is(':checked')){
        notyf.alert("Please Choose an Option From those Listed");
        event.preventDefault();
     }
     if(!$('.ad_edit_cat').is(':checked')){
         notyf.alert("Please Choose an Option From those Listed");
         event.preventDefault();
     }
       if((nameFlag_edit_cat==1)&&(descFlag_edit_cat==1)&&(orderFlag_edit_cat==1)&&($('.visible_edit_cat').is(':checked'))&&($('.comment_edit_cat').is(':checked'))&&($('.ad_edit_cat').is(':checked'))){
           notyf.confirm("You Are All done ");
           
       }


//  let name=document.getElementById('name').value;
//  let desc=document.getElementById('description').value;
//  let order=document.getElementById('order').value;
//  if(!allLetter(name))
//  {


  });

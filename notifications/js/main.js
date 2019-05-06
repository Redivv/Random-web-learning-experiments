$(document).ready(function(){

// Updating the notifications on the start
load_unseen_notification();
// ./

// Validation and Submiting form with AJAX
$('#comment_form').on('submit', function(event){
 event.preventDefault();
 if($('#subject').val() != '' && $('#comment').val() != ''){

  var form_data = $(this).serialize();  // Takes the form inputs and prepares them for ajax send
  $.ajax({  // this request inserts new comment
   url:"insert_comment.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#comment_form')[0].reset();      // since the page was not refreshed we need to reset form manually
    $('.error-block').html("");
    load_unseen_notification();   // afted adding new comment - check notifications
   }
  });
 }
 else{
  $('.error-block').html("Both Fields are Required");
 }
});
// .Validation and Submiting form with AJAX

// Load new notifications after clicking on dropdown - clear the notification number after that
var droped = 0;
$(document).on('click', '.dropdown-toggle', function(){
 $('.count').html('');    // clears the notification number
 if($('li.dropdown').hasClass('open')){
   load_unseen_notification('seen');
   droped = 1;
 }
});
// ./

// Load new notifications after closing the dropdown - clear the notification number and content after that
$(document).on('click', 'body', function(){
 $('.open').removeClass('open');  // since I suck at JS timeline I make dropdown close it's self faster
 if((droped == 1) && (!($('li.dropdown').hasClass('open')))){
   $('.count').html('');  // clears the notification number
   load_unseen_notification('seen2');
   droped = 0;
 }
});
// ./

// Check for new notifications every 5 sec
setInterval(function(){
 load_unseen_notification();
}, 5000);
});
// ./

// Main function for updating notifications
function load_unseen_notification(view = ''){
 $.ajax({     // request asks to check database for new comments and expects data to show in json
  url:"fetch_database.php",
  method:"POST",
  data:{view:view},
  dataType:"json",      // results expected dataType (by default - intelligent guessing)
  success:function(data){
   $('.dropdown-menu').html(data.notification); // showing the notifications
   if(data.unseen_notification > 0){
    $('.count').html(data.unseen_notification);
   }
  }
 });
}

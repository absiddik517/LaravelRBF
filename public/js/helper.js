$(document).ready(function() {

  $.ajaxSetup({
    headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
  });
  
  $('[data-intype="number"]').keyup(function() {
    var value = $(this).val();
    var valid_input = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 
                       '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০',
                        '.'];
    var parts = value.split('');

    var filter_valid = '';

    for (var i = 0; i < parts.length; i++) {
      if($.inArray( parts[i] , valid_input ) >= 0){
        filter_valid += parts[i];
      }else{
        console.log(parts[i] + ' : invalid input');
      }
    }

    $(this).val(filter_valid);
   });
});
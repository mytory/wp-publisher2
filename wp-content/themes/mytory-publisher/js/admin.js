jQuery(document).ready(function($){
  if( ! Modernizr.inputtypes.date){
    $('.js-datepicker').datepicker();
  }
});
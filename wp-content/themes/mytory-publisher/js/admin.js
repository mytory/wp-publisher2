jQuery(document).ready(function($){

  // 브라우저가 달력을 제공하지 않는 경우 달력 호출
  if( ! Modernizr.inputtypes.date){
    $('input[type="date"]').datepicker();
  }

  // 숫자만 남기고 지우기
  if( ! Modernizr.inputtypes.number){
    $('input[type="number"]').blur(function(){
      var new_val = $(this).val().replace(/[^0-9]/g, '');
      $(this).val(new_val);
    });
  }
});
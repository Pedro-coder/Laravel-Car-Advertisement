
   $(document).ready(function() {
     $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
         e.preventDefault();
         $(this).siblings('a.active').removeClass("active");
         $(this).addClass("active");
         var index = $(this).index();
         $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
         $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
     });
      $('#onewayTrip-tab').hide();
      $('#localTrip-tab').hide();
      $('#roundTrip-tab').show();

      $('#localcabBooking-daily-tab').hide();
      $('#localcabBooking-hourly-tab').show();

      $('#shipBooking-RoundTrip-tab').show();
      $('#shipBooking-OneWay-tab').hide();

      $('#hireBoat-RoundTrip-tab').show();
      $('#hireBoat-OneWay-tab').hide();

      $('#bootBusRoundTripTab').show();
      $('#bootBusOneWayTab').hide();

      $('#hireCoach-RT-Tab').show();
      $('#hireCoach-OW-Tab').hide();
      $('#hireCoach-Local-Tab').hide();

      $('#hireCoachDaily').show();
      $('#hireCoachMonthly').hide();
      $('#dailyStartingPoint').show();
      $('#monthlyLocation').hide();

      $('#inbetweenCity').hide();

      $('#anOtherCityOW').hide();

      $('#inbetweenCityRT').hide();

      $('#inbetweenCityOW').hide();
      $('#OW-MC-endDate').hide();
   });
   
   $(document).ready(function() {
     $(".text-setter>li").click(function(e) {
       e.preventDefault();
       $(this).siblings('li.active-nav').removeClass("active-nav");
       $(this).addClass("active-nav");
     });
   });

   var i = 0;
   var original = document.getElementById('repeatTHIS');

   function repeat() {
     var clone = original.cloneNode(true);
     clone.id = "repeatTHIS1" + ++i; 
     original.parentNode.appendChild(clone);
   }

   $('input[name=cabBooking]').change(function(){
      var cabInput = $('input[name=cabBooking]:checked').val();
      if(cabInput=='roundTrip') {
         $('#onewayTrip-tab').hide();
         $('#localTrip-tab').hide();
         $('#roundTrip-tab').show();
      }
      else if(cabInput=='onewayTrip') {
         $('#roundTrip-tab').hide();
         $('#localTrip-tab').hide();
         $('#onewayTrip-tab').show();
      }
      else if(cabInput=='localTrip') {
         $('#roundTrip-tab').hide();
         $('#onewayTrip-tab').hide();
         $('#localTrip-tab').show();
      }
   });

   $('input[name=localcabBooking]').change(function(){
      var localcabInput = $('input[name=localcabBooking]:checked').val();
      if(localcabInput=='hourly') {
         $('#localcabBooking-daily-tab').hide();
         $('#localcabBooking-hourly-tab').show();
      }
      else if(localcabInput=='daily') {
         $('#localcabBooking-hourly-tab').hide();
         $('#localcabBooking-daily-tab').show();
      }
   });
   
   $('input[name=bookShipRadio]').change(function(){
      var bookShipInput = $('input[name=bookShipRadio]:checked').val();
      if(bookShipInput=='shipRoundTrip') {
         $('#shipBooking-RoundTrip-tab').show();
         $('#shipBooking-OneWay-tab').hide();
      }
      else if(bookShipInput=='shipOneWay') {
         $('#shipBooking-RoundTrip-tab').hide();
         $('#shipBooking-OneWay-tab').show();
      }
   });

   $('input[name=hireBoatRadio]').change(function(){
      var bookShipInput = $('input[name=hireBoatRadio]:checked').val();
      if(bookShipInput=='hireBoatRoundTrip') {
         $('#hireBoat-RoundTrip-tab').show();
         $('#hireBoat-OneWay-tab').hide();
      }
      else if(bookShipInput=='hireBoatOneWay') {
         $('#hireBoat-RoundTrip-tab').hide();
         $('#hireBoat-OneWay-tab').show();
      }
   });

   $('input[name=bookBusRadio]').change(function(){
      var bookShipInput = $('input[name=bookBusRadio]:checked').val();
      if(bookShipInput=='busRoundTrip') {
         $('#bootBusRoundTripTab').show();
         $('#bootBusOneWayTab').hide();
      }
      else if(bookShipInput=='busOneWay') {
         $('#bootBusRoundTripTab').hide();
         $('#bootBusOneWayTab').show();
      }
   });

   $('input[name=hireCoachRadio]').change(function(){
      var bookShipInput = $('input[name=hireCoachRadio]:checked').val();
      if(bookShipInput=='hireCoachRoundTrip') {
         $('#hireCoach-RT-Tab').show();
         $('#hireCoach-OW-Tab').hide();
         $('#hireCoach-Local-Tab').hide();
      }
      else if(bookShipInput=='hireCoachOneWay') {
         $('#hireCoach-RT-Tab').hide();
         $('#hireCoach-OW-Tab').show();
         $('#hireCoach-Local-Tab').hide();
      }
      else if(bookShipInput=='hireCoachLocal') {
         $('#hireCoach-RT-Tab').hide();
         $('#hireCoach-OW-Tab').hide();
         $('#hireCoach-Local-Tab').show();
      }
   });

   $('input[name=hireCoachMDRadio]').change(function(){
      var bookShipInput = $('input[name=hireCoachMDRadio]:checked').val();
      if(bookShipInput=='coachDaily') {
         $('#hireCoachDaily').show();
         $('#hireCoachMonthly').hide();
         $('#dailyStartingPoint').show();
         $('#monthlyLocation').hide();
      }
      else if(bookShipInput=='coachMonthly') {
         $('#hireCoachDaily').hide();
         $('#hireCoachMonthly').show();
         $('#dailyStartingPoint').hide();
         $('#monthlyLocation').show();
      }
   });

   $('input[name=boatRTMultipleCities]').click(function(){
      if($(this).prop("checked") == true){
         $('#inbetweenCity').show();
      }
      else if($(this).prop("checked") == false){
         $('#inbetweenCity').hide();
      }
   });

   $('input[name=boatOWMultipleCities]').click(function(){
      if($(this).prop("checked") == true){
         $('#anOtherCityOW').show();
      }
      else if($(this).prop("checked") == false){
         $('#anOtherCityOW').hide();
      }
   });

   $('input[name=coachRTMultipleCities]').click(function(){
      if($(this).prop("checked") == true){
         $('#inbetweenCityRT').show();
      }
      else if($(this).prop("checked") == false){
         $('#inbetweenCityRT').hide();
      }
   });

   $('input[name=coachOWMultipleCities]').click(function(){
      if($(this).prop("checked") == true){
         $('#inbetweenCityOW').show();
         $('#OW-MC-endDate').show();
      }
      else if($(this).prop("checked") == false){
         $('#inbetweenCityOW').hide();
         $('#OW-MC-endDate').hide();
      }
   });

   $('#swapButton').click(function(e) {
      var fromVal = $('#routeFrom').val();
      var toVal = $('#routeTo').val();

      $('#routeFrom').val(toVal);
      $('#routeTo').val(fromVal);
   });

   function incrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal)) {
    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
}

function decrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal) && currentVal > 0) {
    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
}

$('.input-group').on('click', '.button-plus', function(e) {
  incrementValue(e);
});

$('.input-group').on('click', '.button-minus', function(e) {
  decrementValue(e);
});


//travellers functions 

function remove_room(id) {

  var current = $('#'+id+'Room').text();
  if(current > 1)
  {
    current--;
    $('#'+id+'Room').html(current);
  }

}

function add_room(id) {
  var current = $('#'+id+'Room').text();
  current++;
    $('#'+id+'Room').html(current);
 }

function remove_adults(id) {
  var current = $('#'+id+'Adcount').text();
  if(current > 1)
  {
    current--;
    $('#'+id+'Adcount').html(current);
    $('#'+id+'A').html(current);
  }
}

function add_adults(id) {
  var current = $('#'+id+'Adcount').text();
  current++;
    $('#'+id+'Adcount').html(current);
    $('#'+id+'A').html(current);
}

function remove_child(id) {
   var current = $('#'+id+'Childern').text();
    if(current > 0)
    {
      current--;
      $('#'+id+'Childern').html(current);
      $('#'+id+'C').html(current);
    }
}

function add_child(id) {
  var current = $('#'+id+'Childern').text();
  current++;
    $('#'+id+'Childern').html(current);
    $('#'+id+'C').html(current);
}

function remove_infant(id) {
   var current = $('#'+id+'Infants').text();
    if(current > 0)
    {
      current--;
      $('#'+id+'Infants').html(current);
    }
}

function add_infant(id) {
  var current = $('#'+id+'Infants').text();
  current++;
    $('#'+id+'Infants').html(current);
}


function setClass(clas,id) {
 $('#'+id).html(clas);
}

function clear_input(id) {
  $('#'+id).val('');
}
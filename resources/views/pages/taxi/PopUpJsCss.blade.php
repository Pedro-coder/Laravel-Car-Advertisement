<script>
var modal = document.getElementById('addmycarmodel');
var upnext = document.getElementById('upnextmodel');
var backcheck = document.getElementById('backgroundcheck');
var iagreemodel = document.getElementById('iagreemodel');
var uploadlicence = document.getElementById('uploadlicence');
var csvehicleregi = document.getElementById('csvehicleregi');
var details = document.getElementById('details');
var congrats = document.getElementById('congrats');
var checkmystatus = document.getElementById('checkmystatus');

var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var option = null;
function setval(x) { option = x;}

function takephoto(){
  document.getElementById('licensefile').click();
}
function takephotoca(){
  document.getElementById('regdocfile').click(); 
}
function takephotocar(){
  document.getElementById('car_image').click();  
}
function continuefun() {
  var y = option;
  if(y==1){
    modal.style.display = "none";
    upnext.style.display = "block";
  }
}
function fun1(){
  upnext.style.display = "none";
  modal.style.display = "block";
}
function backgroundcheck() {
  upnext.style.display = "none";
  backcheck.style.display = "block"
}
function fun2 (){
  backcheck.style.display = "none";
  upnext.style.display = "block";
}
function agreeandacknowledgemodel() {
  var securitynidnumber = document.getElementById("securitynidnumber").value;
  if(!securitynidnumber)
  {
    alert("Social security /NID number field is required");
    return;
  }
  backcheck.style.display = "none";
  iagreemodel.style.display = "block";
}
function fun3(){
  iagreemodel.style.display = "none";
  backcheck.style.display = "block";
}
function iagreemodelfunction(){
 iagreemodel.style.display = "none";
 uploadlicence.style.display = "block";
}
function fun4(){
  uploadlicence.style.display = "none";
  iagreemodel.style.display = "block";
}
function licenseimgupload(){
  var licensefile = document.getElementById("licensefile").value;
  if(!licensefile)
  {
    alert("Please Upload your Driving license photo");
    return;
  }
  uploadlicence.style.display = "none";
  csvehicleregi.style.display = "block";
}
function fun5(){
  csvehicleregi.style.display = "none";
  uploadlicence.style.display = "block";
}
function regdocimgupload(){
  var regdocfile = document.getElementById("regdocfile").value;
  if(!regdocfile)
  {
    alert("Please Upload photo of CA Vehicle Registration");
    return;
  }
  csvehicleregi.style.display = "none";
  details.style.display = "block"; 
}
function fun6(){
  details.style.display = "none"; 
  csvehicleregi.style.display = "block";
}
function confirm(){
  var car_image = document.getElementById("car_image").value;
  var rate = document.getElementById("rate").value;
  var location = document.getElementById("location").value;
  var carmodelname = document.getElementById("carmodelname").value;
  var car_condition =  document.getElementById("carcondition").value;
  if(!rate)
  {
    alert("Please set Rate per hour");
    return;
  }
  if (!location) 
  {v
    alert("Please insert location");
    return;
  }
  if(!carmodelname)
  {
    alert("Please insert car model name");
    return;
  }
  if(!car_condition)
  {
    alert("Please insert car condition");
    return;
  }
  if(!car_image)
  {
    alert("Please take photo of your car");
    return;
  }
  else
  {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    var form = $('#addnewcarform')[0];
    var data = new FormData(form);
    
    $.ajax({
      type:'POST',
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      url:'/addnewcar',
      data:data,
      success:function(data){
        var details = document.getElementById('details');
        var congrats = document.getElementById('congrats');
        details.style.display = "none"; 
        congrats.style.display = "block"; 
      }
    });

  }

}
function checkmystatusfun(){
  congrats.style.display = "none";
  $.ajax({
    url: "/getactivityjson", 
    type: "get",    
    dataType:"json",   
    success: function (response) 
    {
      console.log(response);
      var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
    }   
    });
  checkmystatus.style.display = "block";
}
function edit(id){
    $.ajax({
        url: "gettaxidetails/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
            console.log(response.license_image);
            var security = response.security_number;
            var output = document.getElementById('output');
            var output2 = document.getElementById('output2');
            var output3 = document.getElementById('output3');
            $('#securitynidnumber').val(security);
            $('#referral').val(response.referral);
            $('#rate').val(response.rate_per_our);
            $('#location').val(response.location);
            $('#carmodelname').val(response.vahical_name);
            $('#carcondition').val(response.condition_note);
            $('#taxiId').val(response.id);
            output.src = "/uploads/license/"+response.license_image;
            output2.src = "/uploads/registration_images/"+response.registration_images;
            output3.src = "/uploads/car_image/"+response.car_image;
        }   
    });
    accountstatus.style.display = "none";
    backgroundcheck.style.display = "block";
}
function delete_car(id)
{
    $.ajax({
        url: "delete_car/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
          var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
        }   
    });
    accountstatus.style.display = "block";
}
function approve_car(id)
{
    $.ajax({
        url: "approve_car/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
          var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
        }   
    });
    accountstatus.style.display = "block";
}
function reject_car(id) {
    $.ajax({
        url: "reject_car/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
          var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
        }   
    });
    accountstatus.style.display = "block";
}
function closemod(){
  checkmystatus.style.display = "none"; 
}
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
main.onclick = function(){
  backcheck.style.display = "none";
  modal.style.display = "block"; 
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
  var loadFileCA = function(event) {
    var output = document.getElementById('output2');
    output.src = URL.createObjectURL(document.getElementById("regdocfile").src);
  };
</script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
.takephoto{
  background-color: #fff;
  border-color: #000;
  border-width: 1px solid;
  padding: 10px;
  width: 100%;
  text-align: center;
  border-radius: 5px;
}
.continue{
  background-color: #006dbc;
  border-color: #006dbc;
  box-shadow: gray;
  padding: 10px;
  width: 100%;
  text-align: center;
  border-radius: 5px;
  color: #fff;
}
.button-blue{
  box-shadow: gray;
  padding: 20px;
  width: 100%;
  text-align: left;
  border-radius: 3px;
  color: #fff;
}
.button-blue:hover{
  background-color: #006dbc;
  border-color: #006dbc;
}
.button-blue:focus{
  background-color: #006dbc;
  border-color: #006dbc;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right!import;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<script type="text/javascript">
var accountstatus = document.getElementById('accountstatus');
var backgroundcheck = document.getElementById('backgroundcheck');
var backgroundcheckview = document.getElementById('backgroundcheckview');
var uploadlicence = document.getElementById('uploadlicence');
var licenceview = document.getElementById('licenceview');
var csvehicleregi = document.getElementById('csvehicleregi');
var regdocimgview = document.getElementById('regdocimgview');
var details = document.getElementById('details');
var viewdetails = document.getElementById('viewdetails');
var congrats = document.getElementById('congrats');

function takephoto(){
  document.getElementById('licensefile').click();
}
function takephotoca(){
  document.getElementById('regdocfile').click(); 
}
function takephotocar(){
  document.getElementById('car_image').click();  
}
function viewcar(id)
{
    $.ajax({
        url: "gettaxidetails/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
            console.log(response.license_image);
            var security = response.security_number;
            var output = document.getElementById('licenceviewimage');
            var output2 = document.getElementById('viedoc');
            var output3 = document.getElementById('carimage');
            $('#viewsecuritynidnumber').val(security);
            $('#rateview').val(response.rate_per_our);
            $('#locationview').val(response.location);
            $('#carmodelnameview').val(response.vahical_name);
            $('#carconditionview').val(response.condition_note);
            $('#taxiId').val(response.id);
            output.src = "/uploads/license/"+response.license_image;
            output2.src = "/uploads/registration_images/"+response.registration_images;
            output3.src = "/uploads/car_image/"+response.car_image;
        }   
    });
    accountstatus.style.display = "none";
    backgroundcheckview.style.display = "block";
}
function nextlicenseimage()
{
    backgroundcheckview.style.display = "none";
    licenceview.style.display = "block";
}
function regdocimgviewfun(){
    licenceview.style.display = "none";   
    regdocimgview.style.display = "block";
}
function nextviewdetails()
{
    regdocimgview.style.display = "none";
    viewdetails.style.display = "block";   
}
function changephotoofdrivinglicense(){
    backgroundcheck.style.display = "none";
    uploadlicence.style.display = "block";
}
function regdocimgupload(){
  csvehicleregi.style.display = "none";
  details.style.display = "block"; 
}
function licenseimgupload(){
  uploadlicence.style.display = "none";
  csvehicleregi.style.display = "block";
}
function accountstatusfun(){
  congrats.style.display = "none";
  accounturl = "/getactivityjson/"+{{$user->id}};
  $.ajax({
    url: accounturl, 
    type: "get",    
    dataType:"json",   
    success: function (response) 
    {
      var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
    }   
    });
    accountstatus.style.display = "block";
}
function delete_car(id)
{
    $.ajax({
        url: "/delete_car/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
          var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
        }   
    });
    accountstatus.style.display = "block";
}
function approve_car(id)
{
    $.ajax({
        url: "/approve_car/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
          var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
        }   
    });
    accountstatus.style.display = "block";
}
function reject_car(id) {
    $.ajax({
        url: "/reject_car/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
          var table = $('#accstatustab');
          table.empty();
          response.forEach(function (value) {
            if (value.status == 1) {sview = "Approved"}else{ sview = "In review"}
               table.append("<div class='alert' role='alert' style='display: inline-flex'>"+
                            "<p style='display:inline-flex' onclick='viewcar("+value.id+")'><i class='fa fa-clock' style='font-size:36px;margin-right: 10px;'></i>"+value.vahical_name +"<br>"+ sview +"</p>"+
                            "<span class='float-right' style='margin-top: 10px;margin-left: 100px;'>"+
                                "<a href='#' onclick='edit("+value.id+")' style='margin :3px;padding: 10px;background-color: #9a9a9a;color: black;'>Edit</a>"+
                                "<a href='#' onclick='delete_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f04726;color: black;'>Delete</a>"+@if(count(Auth::user()->isUserHasTaxiPermission()) >= 1)
                                "<a href='#' onclick='approve_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #5eb44c;color: black;'>Approve</a>"+
                                "<a href='#' onclick='reject_car("+value.id+")' style='margin :3px;padding: 10px;background-color: #f47e2b;color: black;'>Cancel</a>"+@endif
                            "</span>"
                            +"</div>");
          });
        }   
    });
    accountstatus.style.display = "block";
}
function closedetails(){
    viewdetails.style.display = "none";
}
function closemod(){
    accountstatus.style.display = "none";
}
function edit(id){
    $.ajax({
        url: "/gettaxidetails/"+id, 
        type: "get",    
        dataType:"json",   
        success: function (response) 
        {
            //console.log(response.license_image);
            var security = response.security_number;
            var output = document.getElementById('output');
            var output2 = document.getElementById('output2');
            var output3 = document.getElementById('output3');
            $('#securitynidnumber').val(security);
            $('#rate').val(response.rate_per_our);
            $('#referral').val(response.referral);
            $('#location').val(response.location);
            $('#carmodelname').val(response.vahical_name);
            $('#carcondition').val(response.condition_note);
            $('#taxiId').val(response.id);
            output.src = "/uploads/license/"+response.license_image;
            output2.src = "/uploads/registration_images/"+response.registration_images;
            output3.src = "/uploads/car_image/"+response.car_image;
        }   
    });
    accountstatus.style.display = "none";
    backgroundcheck.style.display = "block";
}
function confirm(){
  var rate = document.getElementById("rate").value;
  var location = document.getElementById("location").value;
  var carmodelname = document.getElementById("carmodelname").value;
  var car_condition =  document.getElementById("carcondition").value;
  if(!rate)
  {
    alert("Please set Rate per hour");
    return;
  }
  if (!location) 
  {v
    alert("Please insert location");
    return;
  }
  if(!carmodelname)
  {
    alert("Please insert car model name");
    return;
  }
  if(!car_condition)
  {
    alert("Please insert car condition");
    return;
  }
  else
  {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    var form = $('#updateform')[0];
    var data = new FormData(form);
    
    $.ajax({
      type:'POST',
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      url:'/updatecar',
      data:data,
      success:function(data){
        console.log(data)
        var details = document.getElementById('details');
        var congrats = document.getElementById('congrats');
        details.style.display = "none"; 
        congrats.style.display = "block"; 
      }
    });
  }
}
</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
  var loadFileCA = function(event) {
    var output = document.getElementById('output2');
    output.src = URL.createObjectURL(document.getElementById("regdocfile").src);
  };
</script>
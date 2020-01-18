<div class="col-md-12 col-sm-12 container-fluid">
<form method="POST" action="addnewcar" id="updateform" enctype="multipart/form-data">
  @csrf
  <input type="hidden" id="taxiId" name="id">
<div id="addmycarmodel" class="modal">
  <!-- Modal content -->
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <span class="close" style="align-self: flex-start;">
        <i class="fas fa-close"></i>
      </span>
    </div>
    <h5 style="font-weight: bold;">Tell us about your vehicle</h5>
    <span>
      <input type="button" class="button-blue" onclick="setval(setvalue = 1)" value="I have a qualified vehicle">
      <!-- <button class="button-blue">I have a qualified vehicle</button> -->
    </span><br>
    <span>
      <input type="button" class="button-blue" onclick="setval(setvalue = 2)" value="I need a vehicle">
      <!-- <button class="button-blue">I need a vehicle</button> -->
    </span><br><br>
    <span>
      <button class="continue" onclick="continuefun()" type="button">COUNTINUE</button>
    </span>
  </div>
</div>
<div id="upnextmodel" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun1();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
  <div>
    <div style="padding-top: 50px;padding-bottom: 50px;">
      <p>Up next</p>
      <h4>Background Check</h4>      
    </div>
    <span>
      <button class="continue" onclick="backgroundcheck()" type="button">COUNTINUE</button>
    </span>
  </div>  
</div>
</div>

<div id="backgroundcheck" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun2();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
  <div>
    <div style="padding-top: 25px;padding-bott">
      <h4 style="display: block;">For  authentication purposes, we need your Social Security Number for a background check</h4>
        <label>Social security /NID number </label>
        <div class="input-group">
          <input type="text" class="form-control" id="securitynidnumber" name="securitynidnumber">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
        </div>
        <div style="padding-top: 10px;padding-bottom: 10px;">
          <p>We Partners must go through a background check to maintain safe expirience on the road</p>
        </div>
        <div>
          <p><i class="fas fa-check"></i> Personal information is protected with bank-lavel-security</p>
          <p><i class="fas fa-check"></i> no Credit check -credit won't be affected</p>
        </div>
    </div>
    <span>
      <button class="continue" onclick="agreeandacknowledgemodel()" type="button">COUNTINUE</button>
    </span>
  </div>  
</div>
</div>
<div id="iagreemodel" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun3();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
  <div>
    <div style="padding-top: 25px;padding-bottom: 10px;">
      <h4 style="display: block;">Review the background check discolsure and authorization</h4>
      <hr>
        <div style="padding-top: 10px;padding-bottom: 10px;">
          <p>Background check discolsure</p>
          <p>Uber Technologies,inc.("UTI"), the company that contracts with drivers who provide peer-to-peer transportation services througe the Uber mobile app in California, in committed to safety. As part  of  that commitment,UTI may obtain "consumer report" and/or "investigative consumer reports" (background checks) about you from a consumer report agency in connection with your ablity  to become or remain ad independed transportation provider with an independed contrector relationship with UTI. These reports may include information about your charactor, genral reputation, personal characteristics, and/or made of living.the reports may also include information regarding your criminal history,motor</p>
        </div>
    </div>
    <span>
      <button class="continue" onclick="iagreemodelfunction()" type="button">I AFGREE & ACKNOWLEDGE</button>
    </span>
  </div>  
</div>
</div>
<div id="uploadlicence" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun4();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h4 style="display: block;">Take a photo of your Driver's License</h4>
          <div style="padding-top: 10px;padding-bottom: 10px;">
            <p>Make sure your Driver's License is not expired and avoid using the flase so that your information is clear and visible</p>
            <div>
              <img src="images/Taxi.png" id="output" class="img-thumbnail">
            </div>
          </div>
      </div>
      <span>
        <input type="file" id="licensefile" onchange="loadFile(event)" hidden name="license">
        <button class="takephoto" onclick="takephoto()" type="button">Take photo with my phone</button>
      </span><br><br>
      <span>
        <button class="continue" onclick="licenseimgupload()" type="button">UPLOAD PHOTO</button>
      </span>
    </div>  
  </div>
</div>
<div id="csvehicleregi" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun5();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h4 style="display: block;">Take a photo of your CA Vehicle Registration</h4>
          <div style="padding-top: 10px;padding-bottom: 10px;">
            <p>Make sure your vehicle's make,model,year,license plate,VIN and expiration are clear and visible</p>
            <div>
              <img src="images/Taxica.png" id="output2" class="img-thumbnail">
            </div>
          </div>
      </div>
      <span>
        <input type="file" id="regdocfile" onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])" hidden name="regdocfile">
        <button class="takephoto" onclick="takephotoca()" type="button">Take photo with my phone</button>
      </span><br><br>
      <span>
        <button class="continue" onclick="regdocimgupload()" type="button">UPLOAD PHOTO</button>
      </span>
    </div>  
  </div>
</div>
<div id="details" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun6();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <div class="row">
          <div class="col">
            <label>Rate per hour</label>
            <input type="text" name="rate" id="rate" class="form-control">
          </div>
          <div class="col">
            <label>Referral</label>
            <input type="text" name="referral" id="referral" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type="text" name="location" id="location" class="form-control">
        </div>
        <div class="form-group">
          <label>Car model name</label>
          <input type="text" name="car_name" id="carmodelname" class="form-control">
        </div>
        <div class="form-group">
          <label>Car condition</label>
          <textarea class="form-control" name="car_condition" id="carcondition"></textarea>
        </div>
        <div>
          <label>Car Image</label>
          <div>
            <img src="images/Taxica.png" id="output3" class="img-thumbnail">
          </div>
          <input type="file" id="car_image" onchange="document.getElementById('output3').src = window.URL.createObjectURL(this.files[0])" hidden name="car_image">
          <button class="takephoto" onclick="takephotocar()" type="button">Take photo with my phone</button>
        </div>
      </div>
      <span>
        <button class="continue" onclick="confirm()" type="button">CONTINUE</button>
      </span>
    </div>  
  </div>
</div>
<div id="congrats" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h5>Congrats! You're all done</h5>
        <br>
        <p>You'll be notified by text and email once you're approved to drive</p>
        <div>
          <center>
            <img src="{{asset('images/Taxic.png')}}" class="img-thumbnail">
          </center>
        </div>
        <br>
        <p>you anderstand that, in order to access the Uber app, you will we obligated to transoprt with service animals in accordance with aplicable fedral ,state and local lawa and <a> Uber's Service Animal Policy </a></p>
      <span>
        <button class="continue" onclick="accountstatusfun()" type="button">CHECK MY STATUS</button>
      </span>
    </div>  
  </div>
</div>
</div>
<div id="checkmystatus" class="modal">
  <div class="modal-content col-sm-9 col-md-5">
    <div style="flex-flow: column;">
      <a onclick="closemod();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>      
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <div>
          <center>
            <img src="{{asset('images/taxit.png')}}" class="img-thumbnail"><br>
            <p>Account status</p>
            <h5>In review</h5>
            <p>Review may take a few days</p>
          </center>
        </div><br>
        <p>Your Progress</p>
        <div id="showstatus">
            
        </div>
    </div>  
  </div>
</div>
</div>
</form>
</div>
<form method="POST" action="addnewcar" id="addnewcarform" enctype="multipart/form-data">
@csrf
<input type="hidden" id="taxiId" name="id">
<div id="accountstatus" class="modal">
  <div class="modal-content col-sm-9 col-md-5">
    <div style="flex-flow: column;">
      <a onclick="closemod();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <div>
          <center>
            <img src="{{asset('images/taxit.png')}}" class="img-thumbnail"><br>
            <p>Account status</p>
            <h5>In review</h5>
            <p>Review may take a few days</p>
          </center>
        </div><br>
        <p>Your Progress</p>
        <div id="accstatustab">
            
        </div>
    </div>  
  </div>
</div>
</div>
<div id="backgroundcheck" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun2();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
  <div>
    <div style="padding-top: 25px;padding-bott">
      <h4 style="display: block;">For  authentication purposes, we need your Social Security Number for a background check</h4>
        <label>Social security /NID number </label>
        <div class="input-group">
          <input type="text" class="form-control" id="securitynidnumber" name="securitynidnumber">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
        </div>
        <div style="padding-top: 10px;padding-bottom: 10px;">
          <p>We Partners must go through a background check to maintain safe expirience on the road</p>
        </div>
        <div>
          <p><i class="fas fa-check"></i> Personal information is protected with bank-lavel-security</p>
          <p><i class="fas fa-check"></i> no Credit check -credit won't be affected</p>
        </div>
    </div>
    <span>
      <button class="continue" onclick="changephotoofdrivinglicense()" type="button">COUNTINUE</button>
    </span>
  </div>  
</div>
</div>
<div id="uploadlicence" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun4();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h4 style="display: block;">Take a photo of your Driver's License</h4>
          <div style="padding-top: 10px;padding-bottom: 10px;">
            <p>Make sure your Driver's License is not expired and avoid using the flase so that your information is clear and visible</p>
            <div>
              <img src="images/Taxi.png" id="output" class="img-thumbnail">
            </div>
          </div>
      </div>
      <span>
        <input type="file" id="licensefile" onchange="loadFile(event)" hidden name="license">
        <button class="takephoto" onclick="takephoto()" type="button">Take photo with my phone</button>
      </span><br><br>
      <span>
        <button class="continue" onclick="licenseimgupload()" type="button">UPLOAD PHOTO</button>
      </span>
    </div>  
  </div>
</div>
<div id="licenceview" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun4();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h4 style="display: block;">Take a photo of your Driver's License</h4>
          <div style="padding-top: 10px;padding-bottom: 10px;">
            <p>Make sure your Driver's License is not expired and avoid using the flase so that your information is clear and visible</p>
            <div>
              <img src="images/Taxi.png" id="licenceviewimage" class="img-thumbnail">
            </div>
          </div>
      </div><br><br>
      <span>
        <button class="continue" onclick="regdocimgviewfun()" type="button">Next</button>
      </span>
    </div>  
  </div>
</div>
<div id="regdocimgview" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun5();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h4 style="display: block;">Photo of your CA Vehicle Registration</h4>
          <div style="padding-top: 10px;padding-bottom: 10px;">
            <p>Make sure your vehicle's make,model,year,license plate,VIN and expiration are clear and visible</p>
            <div>
              <img src="images/Taxica.png" id="viedoc" class="img-thumbnail">
            </div>
          </div>
      </div><br><br>
      <span>
        <button class="continue" onclick="nextviewdetails()" type="button">Next</button>
      </span>
    </div>  
  </div>
</div>
<div id="csvehicleregi" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun5();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h4 style="display: block;"> photo of your CA Vehicle Registration</h4>
          <div style="padding-top: 10px;padding-bottom: 10px;">
            <p>Make sure your vehicle's make,model,year,license plate,VIN and expiration are clear and visible</p>
            <div>
              <img src="images/Taxica.png" id="output2" class="img-thumbnail">
            </div>
          </div>
      </div>
      <span>
        <input type="file" id="regdocfile" onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])" hidden name="regdocfile">
        <button class="takephoto" onclick="takephotoca()" type="button">Take photo with my phone</button>
      </span><br><br>
      <span>
        <button class="continue" onclick="regdocimgupload()" type="button">UPLOAD PHOTO</button>
      </span>
    </div>  
  </div>
</div>
<div id="details" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun6();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <div class="row">
          <div class="col">
            <label>Rate per hour</label>
            <input type="text" name="rate" id="rate" class="form-control">
          </div>
          <div class="col">
            <label>Referral</label>
            <input type="text" name="referral" id="referral" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type="text" name="location" id="location" class="form-control">
        </div>
        <div class="form-group">
          <label>Car model name</label>
          <input type="text" name="car_name" id="carmodelname" class="form-control">
        </div>
        <div class="form-group">
          <label>Car condition</label>
          <textarea class="form-control" name="car_condition" id="carcondition"></textarea>
        </div>
        <div>
          <label>Car Image</label>
          <div>
            <img src="images/Taxica.png" id="output3" class="img-thumbnail">
          </div>
          <input type="file" id="car_image" onchange="document.getElementById('output3').src = window.URL.createObjectURL(this.files[0])" hidden name="car_image">
          <button class="takephoto" onclick="takephotocar()" type="button">Take photo with my phone</button>
        </div>
      </div>
      <span>
        <button class="continue" onclick="confirm()" type="button">CONTINUE</button>
      </span>
    </div>  
  </div>
</div>
<div id="viewdetails" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun6();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <div class="form-group">
          <label>Rate per hour</label>
          <input type="text" name="rate" disabled id="rateview" class="form-control">
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type="text" name="location" disabled id="locationview" class="form-control">
        </div>
        <div class="form-group">
          <label>Car model name</label>
          <input type="text" name="car_name" disabled id="carmodelnameview" class="form-control">
        </div>
        <div class="form-group">
          <label>Car condition</label>
          <textarea class="form-control" name="car_condition" disabled id="carconditionview"></textarea>
        </div>
        <div>
          <label>Car Image</label>
          <div>
            <img src="images/Taxica.png" id="carimage" class="img-thumbnail">
          </div>
        </div>
      </div>
      <span>
        <button class="continue" onclick="closedetails()" type="button">Back</button>
      </span>
    </div>  
  </div>
</div>
<div id="congrats" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div>
      <div style="padding-top: 25px;padding-bottom: 10px;">
        <h5>Congrats! You're all done</h5>
        <br>
        <p>You'll be notified by text and email once you're approved to drive</p>
        <div>
          <center>
            <img src="{{asset('images/Taxic.png')}}" class="img-thumbnail">
          </center>
        </div>
        <br>
        <p>you anderstand that, in order to access the Uber app, you will we obligated to transoprt with service animals in accordance with aplicable fedral ,state and local lawa and <a> Uber's Service Animal Policy </a></p>
      <span>
        <button class="continue" onclick="accountstatusfun()" type="button">CHECK MY STATUS</button>
      </span>
    </div>  
  </div>
</div>
</div>
</form>
<div id="backgroundcheckview" class="modal">
  <div class="modal-content col-sm-9 col-md-4">
    <div style="flex-flow: column;">
      <a onclick="fun2();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
    </div>
  <div>
    <div style="padding-top: 25px;padding-bott">
      <h4 style="display: block;">For  authentication purposes, we need your Social Security Number for a background check</h4>
        <label>Social security /NID number </label>
        <div class="input-group">
          <input type="text" class="form-control" id="viewsecuritynidnumber" disabled name="securitynidnumber">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
        </div>
        <div style="padding-top: 10px;padding-bottom: 10px;">
          <p>We Partners must go through a background check to maintain safe expirience on the road</p>
        </div>
        <div>
          <p><i class="fas fa-check"></i> Personal information is protected with bank-lavel-security</p>
          <p><i class="fas fa-check"></i> no Credit check -credit won't be affected</p>
        </div>
    </div>
    <span>
      <button class="continue" onclick="nextlicenseimage()" type="button">Next</button>
    </span>
  </div>  
</div>
</div>
<div id="ratingmodel" class="modal">
    <div class="modal-content col-sm-9 col-md-4">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Click stars for rating</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        <div class="modal-body">
            <div class="nav-item r-l-no-border rating-share-desktop-view">
                <input id="input-2" name="input-2" class="rating rating-loading user-rating"
                       value="{{userReview(Auth::user()->id, $user->id)}}">
            </div>
        </div>  
    </div>  
</div>
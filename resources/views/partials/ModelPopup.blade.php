<!-- New Post -->

<form enctype="multipart/form-data">
    <div id="newpostmodel" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;">Tell us what You want to post</h5>
            <span>
      <input type="button" class="button-blue iwant" id="1" value="I want to buy ">
    </span><br>
            <span>
      <input type="button" class="button-blue iwant" id="2" value="I want to sell">
    </span><br>
            <span>
      <input type="button" class="button-blue iwant" id="3" value="I want to do blog post">
    </span><br>
            <span>
      <input type="button" class="button-blue iwant" id="4" value="I want to post a event">
    </span><br>
            <span>
      <button class="continue" id="continue1" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#newpostmodel').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End New Post -->

    <!-- I want to Buy -->
    <div id="iwanttobuy" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;">I want to buy </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;" id="buyServicMainCategoryName">
                <input type="hidden" id="buyId" name="buy_id">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input iwantbuy" name="iwantbuy" id="1" value="1">Service
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input iwantbuy" name="iwantbuy" id="2" value="2">Product
                    </label>
                </div>
            </div>
            <span>
      <button class="continue" id="iwantbuycoun" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#iwanttobuy').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End I want to Buy -->

    <!-- I want to Buy service-->
    <div id="iwanttobuyservice" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            
            <div style="padding-top: 30px;padding-bottom: 30px;" id="buySubCategoryName">
                
            </div>
            <span>
      <button class="continue" id="takephotophtocoun" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#iwanttobuyservice').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End I want to Buy service-->

    <!-- I want to Buy service-->
     <div id="iwanttobuyproduct" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;">I want to buy a product for </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;" id="buyProductCategoryName">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input buyproduct" name="buy_product" value="1"
                               data-id="1">Car
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input buyproduct" name="buy_product" value="2"
                               data-id="2">House
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input buyproduct" name="buy_product" value="3"
                               data-id="3">Other
                    </label>
                </div>
            </div>
            <span>
      <button class="continue" id="producttakephotophtocoun" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#iwanttobuyproduct').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End I want to Buy service-->

 

    <!-- start congratulation for event -->
    <div id="postbuydone" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail"> Congrats! You're all
                done
                <!-- <a href="#" id="backeventfor"><i class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a> -->
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <br>
                <div>
                    <center>
                        <input type="hidden" name="" id="successbuyId" value="0">
                        <input type="hidden" name="" id="successbuyUserId" value="0">
                        <img src="{{asset('images/Taxic.png')}}" class="img-thumbnail">
                    </center>
                </div>
            </div>
            <span>
      <button class="continue" style="background: #a349a4" id="finalpriviewpost" type="button">PREVIEW</button><br><br>
      <button class="continue" id="submitpostmore" type="button">POST MORE</button><br><br>
       <button class="cancel" onclick="$('#postbuydone').modal('hide');" type="button">CLOSE</button>
    </span>
        </div>
    </div>
  <!-- Sell Design Start -->
        <!-- I want to Sell -->
        <div id="iwanttosell" class="modal">
            <div class="modal-content col-sm-9 col-md-4">
                <h5 style="font-weight: bold;">I want to Sell </h5>
                <div style="padding-top: 30px;padding-bottom: 30px;" id="sellServicMainCategoryName">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="hidden" id="sellId" name="sell_id">
                            <input type="radio" class="form-check-input iwantsell" name="iwantsell" id="1" value="1">Service
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input iwantsell" name="iwantsell" id="2" value="2">Product
                        </label>
                    </div>
                </div>
                <span>
                  <button class="continue" id="iwanttosellcon" type="button">COUNTINUE</button><br><br>
                  <button class="cancel" onclick="$('#iwanttosell').modal('hide');" type="button">CANCEL</button>
                </span>
            </div>
        </div>
        <!-- End I want to sell -->
        <!-- I want to sell service-->
        <div id="iwanttosellservice" class="modal">
            <div class="modal-content col-sm-9 col-md-4">
                <div style="padding-top: 30px;padding-bottom: 30px;" id="sellSubCategoryName">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sellservice" name="service" id="1" value="1">Taxi
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sellservice" name="service" id="2" value="2">Delivery
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sellservice" name="service" id="3" value="3">Hotel
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sellservice" name="service" id="4" value="4">Other
                        </label>
                    </div>
                </div>
                <span>
                  <button class="continue" id="takephotophtosellcoun" type="button">COUNTINUE</button><br><br>
                  <button class="cancel" onclick="$('#iwanttobuy').modal('hide');" type="button">CANCEL</button>
                </span>
            </div>
        </div>
        <!-- End I want to Sell service-->
        <!-- I want to Buy Product-->
        <div id="iwanttosellproduct" class="modal">
            <div class="modal-content col-sm-9 col-md-4">
                <h5 style="font-weight: bold;">I want to Sell a product for </h5>
                <div style="padding-top: 30px;padding-bottom: 30px;" id="sellProductCategoryName">

                    <select class="form-control col-md-6" name="sell_product">
                        <option value="1">Car</option>
                        <option value="2">House</option>
                        <option value="3">Other</option>
                    </select>
                    <!-- <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sellservice" name="service" id="1" value="1">Car
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sellservice" name="service" id="2" value="2">House
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sellservice" name="service" id="4" value="4">Other
                        </label>
                    </div> -->
                </div>
                <span>
                  <button class="continue" id="takephotophtosellcoun1" type="button">COUNTINUE</button><br><br>
                  <button class="cancel" onclick="$('#iwanttobuy').modal('hide');" type="button">CANCEL</button>
                </span>
            </div>
        </div>
        <!-- End I want to Buy service-->
   
        <!-- Take a photo for your post -->
        <div id="takeaphotoforpost" class="modal">
            <div class="modal-content col-sm-9 col-md-4">
                <div>
                    <div style="padding-top: 25px;padding-bottom: 10px;">
                        <h4 style="display: block;">Take a photo for your post</h4>
                        <div style="padding-top: 10px;padding-bottom: 10px;">
                            <div style="text-align: center;padding-top: 10px;padding-bottom: 10px;">
                                  <span class="takeaphotoforpost">
                                    <img src="/images/photo.png" id="podtimage" class="img-thumbnail"><br>
                                  </span>
                                    <i class="fas fa-search-plus"></i> Zoom
                            </div>
                        </div>
                    </div>
                    <span>
                        <input type="file" id="takeaphotoforpostfile"
                               onchange="document.getElementById('podtimage').src = window.URL.createObjectURL(this.files[0])" hidden
                               name="regdocfile">
                        <button class="continue" id="povidedetailcoun" type="button">COUNTINUE</button><br><br>
                    </span>
                    <span>
                        <button class="cancel" onclick="$('#takeaphotoforpost').modal('hide');" type="button">CANCEL</button>
                    </span>
                </div>
            </div>
        </div>
        <!-- Provide details sell -->
        <div id="providedetailsell" class="modal">
            <div class="modal-content col-sm-9 col-md-5">
                <div>
                    <div style="padding-top: 25px;padding-bottom: 10px;">
                        <h3>Provide details</h3>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4"><h5>Sell start rate</h5><br></div>
                                <div class="col-sm-3">
                                    <input type="text" name="sellrate" id="sellrate" class="form-control">
                                </div>
                                <!-- <div class="col-sm-3">
                                    <select name="serviceoptionsell" class="form-control">
                                        <option value="1">Hour</option>
                                        <option value="2">Service</option>
                                        <option value="3">Product</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"><h5>Sell for</h5></div>
                                <div class="col-sm-2">
                                    <input type="text" name="sellhours" id="sellhours" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <h5>Hours</h5>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="sellsubject" id="sellsubject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control" name="selldetails" id="selldetails"></textarea>
                        </div>
                    </div>
                    <span>
                        <button class="continue" id="eventlocationConSell" type="button">CONTINUE</button><br><br>
                      </span>
                                <span>
                        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
                      </span>
                </div>
            </div>
        </div>
        <!-- End Provide details sell -->

        <!-- sell done design -->
        <div id="postselldone" class="modal">
            <div class="modal-content col-sm-9 col-md-4">
                <h5><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail"> Congrats! You're all
                    done
                    <!-- <a href="#" id="backeventfor"><i class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a> -->
                </h5>
                <div style="padding-top: 30px;padding-bottom: 30px;">
                    <br>
                    <div>
                        <center>
                            <input type="hidden" name="" id="successbuyId" value="0">
                            <input type="hidden" name="" id="successbuyUserId" value="0">
                            <img src="{{asset('images/Taxic.png')}}" class="img-thumbnail">
                        </center>
                    </div>
                </div>
                <span>
                  <button class="continue" style="background: #a349a4" id="finalpriviewpost" type="button">PREVIEW</button><br><br>
                  <button class="continue" id="submitpostmore" type="button">POST MORE</button><br><br>
                   <button class="cancel" onclick="$('#postselldone').modal('hide');" type="button">CLOSE</button>
                </span>
            </div>
        </div>

        <!-- Refferance Design -->
        <div id="referenceSellModal" class="modal">
            <div class="modal-content col-sm-9 col-md-5">
                    <h5 style="font-weight: bold;"><span style="top: 20px !important;" class="overlay_badge_sell">Sell</span>
                        <span style="padding-left: 60px;">Reference </span>
                    </h5>
                    <div style="padding-top: 30px;padding-bottom: 30px;">
                        <div class="raw">
                            <div class="col-sm-6 col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5>Is there any reference?</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-8 mx-auto">
                                        <div class="row">
                                            <div style="padding-top: 11px;" class="col-sm-3"><input value="yes" name="is_reference" type="radio"> Yes</div>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <input placeholder="Please enter reference email" type="email" class="form-control"
                                                           id="sellreferenceUserForInProcess">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"><input value="no" type="radio" name="is_reference"> No</div>
                                        </div>
                                        
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <span>
                      <button class="continue" id="sellReferenceContinue" type="button">Submit</button><br><br>
                      <button class="cancel" onclick="$('#referenceSellModal').modal('hide');" type="button">CANCEL</button>
                    </span>
            </div>
        </div>

        <!-- delivery date design -->
        <div id="sellDueDateModal" class="modal">
            <div class="modal-content col-sm-9 col-md-5">
                <h5 style="font-weight: bold;"><span style="top: 20px !important;" class="overlay_badge_sell">Sell</span>
                    <span style="padding-left: 60px;">Delivery Date </span>
                </h5>
                <div style="padding-top: 30px;padding-bottom: 30px;">
                    <div class="raw">
                        <div class="col-sm-6 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="dueDateSelect">
                                        <span class="cop-input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                                    </div>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>

                </div>
                <span>
                  <button class="continue" id="sellDueDateContinue" type="button">CONTINUE</button><br><br>
                  <button class="cancel" onclick="$('#sellDueDateModal').modal('hide');" type="button">CANCEL</button>
                </span>
            </div>
        </div>

    <!-- Sell Design End -->
    <!-- Take a photo of Licens -->
    <div id="takeaphotoflicense" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="flex-flow: column;">
                <a onclick="fun4();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
            </div>
            <div>
                <div style="padding-top: 25px;padding-bottom: 10px;">
                    <h4 style="display: block;">Take a photo of your Driver's License</h4>
                    <div style="padding-top: 10px;padding-bottom: 10px;">
                        <p>Make sure your Driver's License is not expired and avoid using the flase so that your
                            information is clear and visible</p>
                        <div>
              <span id="takephotolicense">
                <img src="images/Taxi.png" id="licenseout" class="img-thumbnail">
              </span>
                        </div>
                    </div>
                </div>
                <span>
        <input type="file" id="licensefile"
               onchange="document.getElementById('licenseout').src = window.URL.createObjectURL(this.files[0])" hidden
               name="license">
      </span><br><br>
                <span>
        <button class="continue" id="takeaphotofcaregistrationcon" type="button">COUNTINUE</button><br><br>
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!-- Take photo of cs registration -->
    <div id="takeaphotofcaregistration" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="flex-flow: column;">
                <a onclick="fun5();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
            </div>
            <div>
                <div style="padding-top: 25px;padding-bottom: 10px;">
                    <h4 style="display: block;">Take a photo of your CA Vehicle Registration</h4>
                    <div style="padding-top: 10px;padding-bottom: 10px;">
                        <p>Make sure your vehicle's make,model,year,license plate,VIN and expiration are clear and
                            visible</p>
                        <div>
              <span id="takephotoofcaregistraion">
                <img src="images/Taxica.png" id="regdocfileout" class="img-thumbnail">
              </span>
                        </div>
                    </div>
                </div>
                <span>
        <button class="continue" id="comisioncoun" type="button">COUNTINUE</button><br><br>
        <input type="file" id="regdocfile"
               onchange="document.getElementById('regdocfileout').src = window.URL.createObjectURL(this.files[0])"
               hidden name="regdocfile">
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!--End Take a photo of Licens -->
    <!-- Take photo of cs registration -->
    <div id="takeaphotofcaregistration" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="flex-flow: column;">
                <a onclick="fun5();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
            </div>
            <div>
                <div style="padding-top: 25px;padding-bottom: 10px;">
                    <h4 style="display: block;">Take a photo of your CA Vehicle Registration</h4>
                    <div style="padding-top: 10px;padding-bottom: 10px;">
                        <p>Make sure your vehicle's make,model,year,license plate,VIN and expiration are clear and
                            visible</p>
                        <div>
              <span id="takephotoofcaregistraion">
                <img src="images/Taxica.png" id="regdocfileout" class="img-thumbnail">
              </span>
                        </div>
                    </div>
                </div>
                <span>
        <button class="continue" id="comisioncoun" type="button">COUNTINUE</button><br><br>
        <input type="file" id="regdocfile"
               onchange="document.getElementById('regdocfileout').src = window.URL.createObjectURL(this.files[0])"
               hidden name="regdocfile">
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!-- End Take photo of cs registration -->
    <!-- Reffral  -->
    <div id="comision" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div>
                <div style="padding-top: 25px;padding-bottom: 10px;">
                    <h4 style="display: block;">Will you provied referal comision for this post</h4>
                    <div style="padding-top: 10px;padding-bottom: 10px;">
                        <p>Make sure your vehicle's make,model,year,license plate,VIN and expiration are clear and
                            visible</p>
                        <div class="alert alert-light" role="alert">
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <i class="fas fa-user-circle fa-5x" style="font-style: 65px;"></i>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xsm-6">
                  <span class="float-right" style="padding: 8px;">
                    <p>Refferal person 10%</p>
                    <p>Bid Winner 10%</p>
                  </span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-share"></i></span>
                            </div>
                            <input type="text" placeholder="20" size="4">
                            <div class="input-group-append">
                                <span class="input-group-text">% Referral</span>
                            </div>
                        </div>
                    </div>
                </div>
                <span>
        <button class="continue" id="upnextcoun" type="button">COUNTINUE</button><br><br>
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!-- End Reffral -->
    <!-- Up next  -->
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
      <button class="continue" id="backgroundcheckcoun" type="button">COUNTINUE</button><br><br>
    </span>
                <span>
      <button class="skip" id="#" type="button">SKIP</button><br><br>
    </span>
                <span>
      <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
    </span>
            </div>
        </div>
    </div>
    <!-- End up next -->
    <!-- BackGround check -->
    <div id="backgroundcheck" class="modal">
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
                        <p>Uber Technologies,inc.("UTI"), the company that contracts with drivers who provide
                            peer-to-peer transportation services througe the Uber mobile app in California, in committed
                            to safety. As part of that commitment,UTI may obtain "consumer report" and/or "investigative
                            consumer reports" (background checks) about you from a consumer report agency in connection
                            with your ablity to become or remain ad independed transportation provider with an
                            independed contrector relationship with UTI. These reports may include information about
                            your charactor, genral reputation, personal characteristics, and/or made of living.the
                            reports may also include information regarding your criminal history,motor</p>
                    </div>
                </div>
                <span>
      <button class="continue" id="authenticationpurposescoun" type="button">COUNTINUE</button><br><br>
    </span>
                <span>
      <button class="skip" id="#" type="button">SKIP</button><br><br>
    </span>
                <span>
      <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
    </span>
            </div>
        </div>
    </div>
    <!-- End Background check -->
    <!-- Authentication purposes -->
    <div id="authenticationpurposes" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="flex-flow: column;">
                <a onclick="fun2();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
            </div>
            <div>
                <div style="padding-top: 25px;padding-bott">
                    <h4 style="display: block;">For authentication purposes, we need your Social Security Number for a
                        background check</h4>
                    <label>Country </label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="securitynidnumber" name="securitynidnumber">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>
                    <label>Phone Number</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="securitynidnumber" name="securitynidnumber">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>
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
        <button class="continue" id="uploadphotocoun" type="button">COUNTINUE</button><br><br>
      </span>
                <span>
        <button class="skip" id="#" type="button">SKIP</button><br><br>
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!-- End Authentication purposes -->
    <!-- Uplaod Photo -->
    <div id="uplaodphoto" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="flex-flow: column;">
                <a onclick="fun5();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
            </div>
            <div>
                <div style="padding-top: 25px;padding-bottom: 10px;">
                    <h5 style="display: block;">Upload your photo </h5>
                    <div style="padding-top: 10px;padding-bottom: 10px;">
                        <div>
              <span id="uplaodphotofun">
                <img src="/images/photo.png" id="uplaodphotoout" class="img-thumbnail">
              </span>
                        </div>
                    </div>
                </div>
                <input type="file" id="uplaodphototri"
                       onchange="document.getElementById('uplaodphotoout').src = window.URL.createObjectURL(this.files[0])"
                       hidden name="regdocfile">
                <span>
        <button class="continue" id="uploadidphotocun" type="button">COUNTINUE</button><br><br>
      </span>
                <span>
        <button class="skip" id="#" type="button">SKIP</button><br><br>
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!-- End Uplaod Photo -->
    <!-- Upload Id Card  -->
    <div id="uplaodidcardphoto" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="flex-flow: column;">
                <a onclick="fun5();"><i class="fas fa-arrow-left" style="align-self: flex-start;"></i></a>
            </div>
            <div>
                <div style="padding-top: 25px;padding-bottom: 10px;">
                    <h5 style="display: block;">Take photo by this device camera with any of your identity card</h5>
                    <div style="padding-top: 10px;padding-bottom: 10px;">
                        <div>
              <span id="uplaodidphotofun">
                <img src="/images/photo.png" id="uplaodidphotoout" class="img-thumbnail">
              </span>
                        </div>
                    </div>
                </div>
                <input type="file" id="uplaodidphototri"
                       onchange="document.getElementById('uplaodidphotoout').src = window.URL.createObjectURL(this.files[0])"
                       hidden name="regdocfile">
                <span>
        <button class="continue" id="alldonecoun" type="button">COUNTINUE</button><br><br>
      </span>
                <span>
        <button class="skip" id="#" type="button">SKIP</button><br><br>
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailsell').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!-- Upload Id Card  -->
    <!-- You're All Done -->
    <div id="alldone" class="modal">
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
                    <p>you anderstand that, in order to access the Uber app, you will we obligated to transoprt with
                        service animals in accordance with aplicable fedral ,state and local lawa and <a> Uber's Service
                            Animal Policy </a></p>
                    <span>
        <button class="continue" id="#" type="button">CHECK MY STATUS</button><br><br>
      </span>
                    <span>
        <button style="background-color: #a457a4;" class="continue" id="#" type="button">PREVIEW</button><br><br>
      </span>
                    <span>
        <button style="background-color: #5db24d;" class="continue" id="#" type="button">POST MORE</button><br><br>
      </span>
                    <span>
        <button class="cancel" id="#" type="button">CLOSE</button><br><br>
      </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End You're All Done -->
    <!-- Provide details Buy -->
    <div id="providedetailbuy" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div>
                <div style="padding-top: 25px;padding-bottom: 10px;">
                    <h3>Provide details</h3>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"><h5>Bid start rate</h5><br></div>
                            <div class="col-sm-3">
                                <input type="text" name="bidrate" id="bidrate" class="form-control">
                            </div>
                            <!-- <div class="col-sm-3">
                                <select name="serviceoptionbuy" class="form-control">
                                    <option value="1">Hour</option>
                                    <option value="2">Service</option>
                                    <option value="3">Product</option>
                                </select>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"><h5>Bid for</h5></div>
                            <div class="col-sm-2">
                                <input type="text" name="bidhours" id="bidhours" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <h5>Hours</h5>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="buysubject" id="buysubject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <textarea class="form-control" name="buydetails" id="buydetails"></textarea>
                    </div>
                </div>
                <span>
        <button class="continue" id="eventlocationCon" type="button">CONTINUE</button><br><br>
      </span>
                <span>
        <button class="cancel" onclick="$('#providedetailbuy').modal('hide');" type="button">CANCEL</button>
      </span>
            </div>
        </div>
    </div>
    <!-- End Provide details Buy -->
    <!-- Take a photo for your post -->
     <!-- start event post name -->
     <div id="selecteventgpostname" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="padding-top: 30px;padding-bottom: 30px;" id="eventMainCategoryName">
               
            </div>
            <span>
      <button class="continue" id="submiteventpostname" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#selectblogpostname').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- end -->
    <!-- I want to post event -->
    <div id="iwanttopostevent" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> What the event for? <a href="#"
                                                                                              id="backeventfor"><i
                            class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-12 col-md-12">
                        <input type="hidden" id="editStatus">
                        <input type="hidden" id="eventId">
                        <input type="hidden" id="userId">
                        <input type="text" class="form-control eventfor" name="eventfor" id="eventfor" value=""
                               required>

                    </div>


                </div>
            </div>

            <span>
      <button class="continue" id="submiteventfor" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#iwanttopostevent').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End I want to post event -->
    <!-- start upload event banner -->
    <div id="uploadeventbanner" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="padding-top: 25px;padding-bottom: 10px;">
                <h4 style="display: block;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                 class="img-thumbnail"> Upload Event banner<a href="#"
                                                                                              id="backuploadevent"><i
                                class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
                </h4>
                <div style="padding-top: 10px;padding-bottom: 10px;">
                    <div style="text-align: center;padding-top: 10px;padding-bottom: 10px;">
              <span class="uploadeventbanner">
                <img src="/images/photo.png" id="uploadBanner" class="img-thumbnail"><br>
              </span>
                        <!--  <i class="fas fa-search-plus"></i> Zoom -->
                    </div>
                </div>
            </div>
            <span>
        <input type="file" id="eventuploadphoto"
               onchange="document.getElementById('uploadBanner').src = window.URL.createObjectURL(this.files[0])" hidden
               name="regdocfile">
      <button class="continue" id="submituploadevent" type="button">COUNTINUE</button><br><br>
      <button class="btn btn-danger" style="width: 100%" id="skipuploadevent" type="button">Skip</button><br><br>
      <button class="cancel" onclick="$('#uploadeventbanner').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End upload event banner -->
    <!-- start about the event -->
    <div id="aboutevent" class="modal">
        <div class="modal-content col-sm-9 col-md-6">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> About the event <a href="#"
                                                                                          id="backabpotevent"><i
                            class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-12 col-md-12">

                        <div class="form-group">
                            <textarea class="form-control" id="event_description" name="content" rows="5"
                                      placeholder="Type your Event discription Here..."></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <span>
      <button class="continue" id="submitabpotevent" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#aboutevent').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End upload event banner -->
    <!-- start event location -->
    <div id="eventlocation" class="modal">
        <div class="modal-content col-sm-9 col-md-6">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> Event location

                <a href="#" id="backeventlocation"><i class="fa fa-arrow-circle-o-left"
                                                      style="font-size:48px;color:red;float: right"></i></a>

            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <style type="text/css">
                    .input-controls {
                        margin-top: 10px;
                        border: 1px solid transparent;
                        border-radius: 2px 0 0 2px;
                        box-sizing: border-box;
                        -moz-box-sizing: border-box;
                        height: 32px;
                        outline: none;
                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                    }

                    #searchInput {
                        background-color: #fff;
                        font-family: Roboto;
                        font-size: 15px;
                        font-weight: 300;
                        margin-left: 12px;
                        padding: 0 11px 0 13px;
                        text-overflow: ellipsis;
                        width: 50%;
                    }

                    #searchInput:focus {
                        border-color: #4d90fe;
                    }
                </style>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADz6E23AjwmwfAKvIFJOnxhA6cRRF_2CM&libraries=places&callback=initAutocomplete"></script>
                <script>
                    /* script */
                    function initialize() {
                        var latitude = document.getElementById('lat').value;
                        var longitude = document.getElementById('lng').value;
                        var latlng = new google.maps.LatLng(latitude, longitude);
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: latlng,
                            zoom: 13
                        });
                        var marker = new google.maps.Marker({
                            map: map,
                            position: latlng,
                            draggable: true,
                            anchorPoint: new google.maps.Point(0, -29)
                        });
                        var input = document.getElementById('searchInput');
                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                        var geocoder = new google.maps.Geocoder();
                        var autocomplete = new google.maps.places.Autocomplete(input);
                        autocomplete.bindTo('bounds', map);
                        var infowindow = new google.maps.InfoWindow();
                        autocomplete.addListener('place_changed', function () {
                            infowindow.close();
                            marker.setVisible(false);
                            var place = autocomplete.getPlace();
                            if (!place.geometry) {
                                window.alert("Autocomplete's returned place contains no geometry");
                                return;
                            }

                            // If the place has a geometry, then present it on a map.
                            if (place.geometry.viewport) {
                                map.fitBounds(place.geometry.viewport);
                            } else {
                                map.setCenter(place.geometry.location);
                                map.setZoom(17);
                            }

                            marker.setPosition(place.geometry.location);
                            marker.setVisible(true);

                            bindDataToForm(place.formatted_address, place.geometry.location.lat(), place.geometry.location.lng());
                            infowindow.setContent(place.formatted_address);
                            infowindow.open(map, marker);

                        });
                        // this function will work on marker move event into map
                        google.maps.event.addListener(marker, 'dragend', function () {
                            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    if (results[0]) {
                                        bindDataToForm(results[0].formatted_address, marker.getPosition().lat(), marker.getPosition().lng());
                                        infowindow.setContent(results[0].formatted_address);
                                        infowindow.open(map, marker);
                                    }
                                }
                            });
                        });
                    }

                    function bindDataToForm(address, lat, lng) {
                        document.getElementById('location').value = address;
                        document.getElementById('lat').value = lat;
                        document.getElementById('lng').value = lng;
                    }

                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>
                <div class="raw">
                    <div class="col-sm-12 col-md-12">
          <span id="mapSearchCheck">
           <input id="searchInput" class="input-controls" type="text" placeholder="Enter a location"></span>
                        <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                        <div class="form_area">
                            <input type="hidden" name="location" id="location">
                            <input type="hidden" name="lat" id="lat" value="23.022505">
                            <input type="hidden" name="lng" id="lng" value="72.57136209999999">
                            <input type="hidden" id="checkBackbutton" name="" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <span id="checkVisiblebutton">
      <button class="continue" id="submiteventlocation" type="button">CONTINUE</button><br><br>
      <button class="cancel" onclick="$('#eventlocation').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>

    <!-- End event location -->
    <!-- start free to join -->
    <div id="freejoin" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> Is it FREE to join <a href="#" id="backfreejoin"><i
                            class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="eventJoinType" id="freeJoin" value="Free">Free
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="eventJoinType" id="notFreeJoin"
                               value="Not Free">Not Free &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="joinType"
                                                                                                    style="display: none">$ <input
                                    type="text" id="eventFee" name=""></span>
                    </label>
                </div>
            </div>
            <span>
      <button class="continue" id="submitfreejoin" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#freejoin').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End free to join -->
    <!-- start referral comission -->
    <div id="referralcomission" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                Will you provide referral comission <a href="#" id="backreffalcom"><i class="fa fa-arrow-circle-o-left"
                                                                                      style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 10px;padding-bottom: 10px;">
                <span class="d-none float-right" style="padding: 8px;">
                    <p>Referral person </p>
                    <p>Perticipent <span id="bidWin">10 </span>%</p>
                  </span>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-share"></i></span>
                    </div>
                    <input type="text" placeholder="20" id="referralPer" onchange="ReferralOnchange()"
                           onmouseup="ReferralMouseUp()" size="4">
                    <div class="input-group-append">
                        <span class="input-group-text">% Referral</span>
                    </div>
                </div>
                <div style="padding: 10px;">
                    If order any done by referral you will provide 15% service fee. From here referee will get <span id="refPer">10 </span>%
                    <br>
                    else your service fee will be 20%
                </div>
            </div>
            <span>
      <button class="continue" id="submitfereffalcom" type="button">CONTINUE</button><br><br>
      <button class="cancel" onclick="$('#referralcomission').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End referral comission -->
    <!-- start need to approval for event  -->
    <div id="needtoapprovalforevent" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                To join need approval <a href="#" id="backneedapprovalevent"><i class="fa fa-arrow-circle-o-left"
                                                                                style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="eventApproval" id="1" value="Yes">Yes
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="eventApproval" id="2" value="No">No
                    </label>
                </div>
            </div>
            <span>
      <button class="continue" id="submitneedapprovalevent" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#needtoapprovalforevent').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End referral comission -->
    <!-- start total tickets for event  -->
    <div id="eventTickets" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                Total Tickets <a href="#" id="backneedapprovalevent"><i class="fa fa-arrow-circle-o-left"
                                                                                style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="form-check">
                    <label class="form-check-label">
                        Add Events Tickets
                    </label>
                    <input type="text" class="form-control" name="eventTickets" id="eventTicket">
                </div>
               
            </div>
            <span>
      <button class="continue" id="submiteventtickets" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#eventTickets').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End total tickets for event -->
    <!-- start date time for event  -->


    <div id="datetimeforevent" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                Set the date/time for the event <a href="#" id="backdatetimeevent"><i class="fa fa-arrow-circle-o-left"
                                                                                      style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-6 col-md-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="hidden" name="" id="checkUpdate" value="0">
                                    <input type="text" class="form-control" id="eventStartDate">
                                    <span class="cop-input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="eventEndDate">

                                    <span class="cop-input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                                </div>
                            </div>
                            <br/>
                            <div class="col-sm-12 col-md-6">
                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="start_house">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="start_minit">
                                            <?php
                                            for($i = 0; $i < 60 ; $i++)
                                            {
                                            $i = sprintf("%02d", $i);
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="startTimeType">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">

                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="end_house">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="end_minit">
                                            <?php
                                            for($i = 0; $i < 60 ; $i++)
                                            {
                                            $i = sprintf("%02d", $i);
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="end_time_type">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <span>
      <button class="continue" id="submitdatetimeevent" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#datetimeforevent').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End date time for event -->


    <div id="dueDateModal" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><span style="top: 20px !important;" class="overlay_badge_buy">Buy</span>
                <span style="padding-left: 60px;">Delivery Date </span>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-6 col-md-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="dueDateSelect">
                                    <span class="cop-input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>

            </div>
            <span>
      <button class="continue" id="dueDateContinue" type="button">CONTINUE</button><br><br>
      <button class="cancel" onclick="$('#dueDateModal').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>


    <div id="referenceModal" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><span style="top: 20px !important;" class="overlay_badge_buy">Buy</span>
                <span style="padding-left: 60px;">Reference </span>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-6 col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Is there any reference?</h5>
                            </div>
                            <div class="col-sm-12 col-md-8 mx-auto">
                                <div class="row">
                                    <div style="padding-top: 11px;" class="col-sm-3"><input value="yes" name="is_reference" type="radio"> Yes</div>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <input placeholder="Please enter reference email" type="email" class="form-control"
                                                   id="referenceUserForInProcess">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"><input value="no" type="radio" name="is_reference"> No</div>
                                </div>
                                
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>

            </div>
            <span>
      <button class="continue" id="referenceContinue" type="button">Submit</button><br><br>
      <button class="cancel" onclick="$('#referenceModal').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>

    <!-- start participent list  -->
    <div id="participentlist" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> Perticipent List </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-6 col-md-12" id="table">

                    </div>
                </div>

            </div>
            <span>

      <button class="continue" id="addMore" type="button">Add date</button><br><br>
      <button class="btn btn-success" style="width: 100%" id="eventpublish" type="button">Publish</button><br><br>
      <button class="continue" style="background: lightgray" id="submitsaveindraft" type="button">Save as druft</button><br><br>
      <button class="cancel" onclick="$('#participentlist').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- End participent list -->

    <!-- start congratulation for event -->
    <div id="eventdone" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5><img src="/images/eventLogo.png" style="height: 50px" id="" class="img-thumbnail"> Congrats! You're all
                done
                <!-- <a href="#" id="backeventfor"><i class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a> -->
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <br>
                <div>
                    <center>
                        <input type="hidden" name="" id="successEventId" value="0">
                        <input type="hidden" name="" id="successUserId" value="0">
                        <img src="{{asset('images/Taxic.png')}}" class="img-thumbnail">
                    </center>
                </div>
            </div>
            <span>
      <button class="continue" style="background: #a349a4" id="finalpriviewevent" type="button">PREVIEW</button><br><br>
      <button class="continue" id="submitpostmore" type="button">POST MORE</button><br><br>
       <button class="cancel" onclick="$('#eventdone').modal('hide');window.location = '/home';"
               type="button">CLOSE</button>
    </span>
        </div>
    </div>
    <div id="checkReferral" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                Is There Any Referral to get discount 
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="referralStatus" id="referralYes" value="Yes">Yes
                    </label>&nbsp;&nbsp;&nbsp;
                    <label class="form-check-label">
                        <input type="text" class="form-control" name="" placeholder="Referral Email" id="enterReferral" style="display: none">
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="referralStatus" id="referralNo" value="No">No
                    </label>
                </div>
            </div>
            <span>
              <button class="continue" id="submitReferralYes" type="button">COUNTINUE</button><br><br>
              <button class="cancel" onclick="$('#checkReferal').modal('hide');" type="button">CANCEL</button>
            </span>
        </div>
    </div>

    <div id="bokkingTicket" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                How many ticket are booking
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="form-check">
                   
                    <label class="form-check-label">
                        How many tickets <input type="text" name="numberOfticket" id="numberOfticket" onchange="ticketBook()" ><br/><input type="hidden" name="ticketEValue" id="ticketEValue">
                        <span id="enterTicketBook">1</span> * <span id="ticketEventPrice"></span> = <span id="totalTaount"></span> <b>Total Amount</b>
                    </label>
                </div>
               
            </div>
            <span style="text-align: center">
              <button style="" class="btn btn-info" id="submitTicketBokking" type="button">Apply</button>
              <button class="btn btn-warning" onclick="$('#bokkingTicket').modal('hide');" type="button">CANCEL</button>
            </span>
        </div>
    </div>

    @if(!empty(Auth::user()->id))
        @if(isFollowing(Auth::user()->id, 2))
            ?>
            <style>
                .following-dropdown {
                    display: block;
                }

                .follow-btn {
                    display: none;
                }
            </style>
        @else
            <style>
                .following-dropdown {
                    display: none;
                }

                .follow-btn {
                    display: block;
                }
            </style>
    @endif

@endif

<!-- view event details -->
    <div id="eventAllDetails" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <div style="padding-top: 20px;padding-bottom: 20px;padding-left: 20px;padding-right: 20px;">
                <div class="row">
                    <div class="col-md-2"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                               class="img-thumbnail"></div>
                    <div class="col-md-8"><h5 id="eventDetailsTitle"> Congrats! You're all done<br/>
                            <span style="color: black;font-size: 18px;background: lightgray;padding: 3px">Friday, June 2, 2007</span>&nbsp;<span
                                    style="color: black;font-size: 15px;background: lightgray;padding: 3px"> 8:00 AM</span>
                        </h5></div>
                    <div class="col-md-2" id="eventMultDate"><a href="#"><i class="fa fa-calendar fa-2x"
                                                                            style="font-size:48px;color:red;float: right"></i></a>
                    </div>
                </div>

                <div style="">
                    <br>
                    <div>
                        <center>
                            <img src="{{asset('/images/image_not_found.jpg')}}" id="eventDetailsImage"
                                 class="img-thumbnail">
                        </center>
                    </div>
                </div>

                <div>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-md-1" id="shareItem">
                        <i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i>
                    </div>
                    <div class="col-md-2" style="" id="savedItem">
                        <center><i class="far fa-star fa-1x"></i></center>
                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-2" style="color: blue" id='going'>
                        35 going
                    </div>
                    <div class="col-md-3" style="color: blue" id='waiting'>
                        560 waiting
                    </div>
                    <div class="col-md-2" id="allGoingChangeDesign">
                        <img = src="/images/going.png" id="goingStatusImage"  style="width: 80px
                        ;
                            height: 30px"/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-11" id="eventDetailsAddress">
                        Adressssssssssssssssssssssssssssssssssssssss
                    </div>
                    <div class="col-md-1" id="mapAddress">
                        <i class="fa fa-map-marker fa-2x" aria-hidden="true" style="color: red;"></i>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12" id="eventDetailsDescription">
                        Description
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <br/>
                        <div class="row">
                            <div class="col-md-2">
                                <span id="userProfile">Address</span>
                                <span id="userProfileImage"><img src="/images/going.png" id="profilePhoto" style="width: 50px
                                    ;
                                        height: 50px"/></span>
                            </div>
                            <div class="col-md-4">
                                <?php
                                if(!empty(Auth::user()->id))
                                {
                                ?>
                                <input id="ownRatingPopup" name="ownRating" class="rating rating-loading own-rating"
                                       value="{{averageReview(Auth::user()->id)}}"
                                       style="padding-top: 8px;"><br/>
                                <?php
                                }
                                ?>

                                <div id="followingValue">

                                </div>
                                <br/>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <span id="editUserEvent">

          </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- view event details -->
    <div id="buySellDetails" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <div style="padding-top: 20px;padding-bottom: 20px;padding-left: 20px;padding-right: 20px;">
                <div class="row">
                    <div class="col-md-2" id="buySellLogo"><img src="/images/eventLogo.png" style="height: 50px"
                                                                class="img-thumbnail"></div>
                    <div class="col-md-8"><h5 id="buySellDetailsTitle"> Congrats! You're all done<br/>
                            <span style="color: black;font-size: 18px;background: lightgray;padding: 3px">Friday, June 2, 2007</span>&nbsp;<span
                                    style="color: black;font-size: 15px;background: lightgray;padding: 3px"> 8:00 AM</span>
                        </h5></div>
                </div>

                <div style="">
                    <br>
                    <div>
                        <center>
                            <img src="{{asset('images/image_not_found.jpg')}}" id="buySellDetailsImage"
                                 class="img-thumbnail">
                        </center>
                    </div>
                </div>

                <div>
                    <hr>
                </div>

                <div class="row">

                    <div class="col-md-1" id="shareItem">
                        <i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i>
                    </div>
                    <div class="col-md-2" style="" id="buySellDetailsSavedItem">
                        <center><i class="far fa-star fa-1x"></i></center>
                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-2" style="color: blue" id='buySellDetailsOrders'>
                        35 going
                    </div>
                    <div class="col-md-3" style="color: blue" id='buySellDetailsBids'>
                        560 waiting
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-11" id="buySellDetailsAddress">
                        Adressssssssssssssssssssssssssssssssssssssss
                    </div>
                    <div class="col-md-1" id="buySellDetailsMapAddress">
                        <i class="fa fa-map-marker fa-2x" aria-hidden="true" style="color: red;"></i>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12" id="buySellDetailsDescription">
                        Description
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <br/>
                        <div class="row">
                            <div class="col-md-2">
                                <span id="buySellDetailsUserProfile">Address</span>
                                <span id="buySellDetailsUserProfileImage"><img src="/images/going.png"
                                                                               id="buySellDetailsProfilePhoto"
                                                                               style="width: 50px;height: 50px"/></span>
                            </div>
                            <div class="col-md-4">
                                <?php
                                if(!empty(Auth::user()->id))
                                {
                                ?>
                                <input class="ownRating rating rating-loading own-rating"
                                       value="{{averageReview(Auth::user()->id)}}"
                                       style="padding-top: 8px;"><br/>
                                <?php
                                }
                                ?>
                                <div id="buySellFollowingValue">

                                </div>
                                <br/>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div id="eidtbuySellDetails">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="eventEditDateTimeList" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> Schedule </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;" id="eventDateTime">

                <div class="raw">
                    <div class="col-sm-6 col-md-12" id="table1">

                    </div>
                </div>

            </div>

        </div>
    </div>

    <div id="editEventDateTime" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                Set the date/time<a href="#" id="backeditdatetimeevent"><i class="fa fa-arrow-circle-o-left"
                                                                           style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-6 col-md-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="hidden" name="" id="editcheckUpdate" value="0">
                                    <input type="text" class="form-control" id="editeventStartDate">
                                    <span class="cop-input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">

                                    <input type="text" class="form-control" id="editeventEndDate">
                                    <span class="cop-input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                                </div>
                            </div>
                            <br/>
                            <div class="col-sm-12 col-md-6">
                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstart_house">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstart_minit">
                                            <?php
                                            for($i = 0; $i < 60 ; $i++)
                                            {
                                            $i = sprintf("%02d", $i);
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstartTimeType">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">

                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_house">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_minit">
                                            <?php
                                            for($i = 0; $i < 60 ; $i++)
                                            {
                                            $i = sprintf("%02d", $i);
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_time_type">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <span>
      <button class="continue" id="submiteditdatetimeevent" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#editEventDateTime').modal('hide');$('#eventAllDetails').modal('show');"
              type="button">CANCEL</button>
    </span>
        </div>
    </div>

    <!-- Going Participent list design start -->
    <div id="goingparticipentlist" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> Going Participent List <a href="#"
                                                                                                 id="backtoalldetailsgoinglist"><i
                            class="fa fa-arrow-circle-o-left"
                            style="font-size:48px;color:red;float: right"></i></a><br/> <span
                        style="color: blue;text-align: right;float: right" id="countGoingShow">35 going</span></h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">

                <div class="raw">
                    <div class="col-sm-6 col-md-12" id="eventParticepentGoingList">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control input-small" name="">
                                    <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control input-small" name="">
                                    <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                                </div>
                            </div>
                            <br/>
                            <div class="col-sm-12 col-md-6">
                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstart_house">
                                            <option>01</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstart_minit">
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstartTimeType">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">

                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_house">
                                            <option>01</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_minit">

                                            <option value="1">1</option>


                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_time_type">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10" style="color: blue">0 waiting</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                ABC
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                ABC
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- End -->

    <!-- Buy order participant list design start -->
    <div id="buyOrderParticipantList" class="modal">
        <div class="modal-content col-sm-12 col-md-10">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"><span class="participantlisttitle">Participant List</span>
                <a href="#"
                   id="backtoalldetailsbuyorderlist"><i
                            class="fa fa-arrow-circle-o-left"
                            style="font-size:48px;color:red;float: right"></i></a><br/> <span
                        style="font-size: 15px;color: blue;text-align: right;float: right" id="countBuyOrderShow">35 going</span>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">

                <div class="row">
                    <div class="col-sm-6 col-md-12" id="buyParticipantOrderList">
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                ABC
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                ABC
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- End -->
    <style>
        #buyBidParticipantList .rate-profile .rating-container {
            margin: 0 15px;
            display: inline;
        }
        #buyOrderParticipantList .rate-profile .rating-container {
            margin: 0 15px;
            display: inline;
        }
    </style>
    <!-- Buy order participant list design start -->
    <div id="buyBidParticipantList" class="modal">
        <div class="modal-content col-sm-12 col-md-10">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> <span class="participantlisttitle">Participant List </span><a
                        href="#"
                        id="backtoalldetailsbuybidlist"><i
                            class="fa fa-arrow-circle-o-left"
                            style="font-size:48px;color:red;float: right"></i></a><br/> <span
                        style="font-size: 15px;color: blue;text-align: right;float: right"
                        id="countBuyBidShow">35 going</span></h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">

                <div class="row">
                    <div class="col-sm-6 col-md-12" id="buyParticipantBidList">
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                ABC
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                ABC
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- End -->

    <!-- Waiting Participent list design start -->
    <div id="waitingparticipentlist" class="modal">
        <div class="modal-content col-sm-9 col-md-5">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" id=""
                                                class="img-thumbnail"> Waiting Participent List <a href="#"
                                                                                                   id="backtoalldetailswitinglist"><i
                            class="fa fa-arrow-circle-o-left"
                            style="font-size:48px;color:red;float: right"></i></a><br/> <span
                        style="color: blue;text-align: right;float: right" id="countWaitingShow">35 going</span></h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">

                <div class="raw">
                    <div class="col-sm-6 col-md-12" id="eventParticepentWaitingList">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control input-small" name="">
                                    <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control input-small" name="">
                                    <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                                </div>
                            </div>
                            <br/>
                            <div class="col-sm-12 col-md-6">
                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstart_house">
                                            <option>01</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstart_minit">
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editstartTimeType">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">

                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-clock-o" style="width: 10px;padding: 10px"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_house">
                                            <option>01</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_minit">

                                            <option value="1">1</option>


                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select style="padding: 5px" id="editend_time_type">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10" style="color: blue">0 waiting</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                ABC
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                ABC
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- End -->

    <!-- event address -->

    <!-- End event location -->
     <!-- Blog Design Start -->
      <!-- Blog Post Choice -->
    <div id="selectblogpostname" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="padding-top: 30px;padding-bottom: 30px;" id="blogMainCategoryName">
               
            </div>
            <span>
      <button class="continue" id="submitblogpostname" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#selectblogpostname').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>
    <!-- blog subject -->
    <div id="iwanttopostblog" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i> What your blog subject ? <a href="#" id="backeventfor" onclick="$('#iwanttopostblog').modal('hide');$('#newpostmodel').modal('show');"><i
                            class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-12 col-md-12">
                        <input type="hidden" id="blogId" name="blog_id">
                        <input type="hidden" id="editBlogStatus" value="0">
                        <input type="text" class="form-control eventfor" name="blogSubject" id="blogSubject" value=""
                               required>

                    </div>


                </div>
            </div>

            <span>
              <button class="continue" id="submitblogsubject" type="button">COUNTINUE</button><br><br>
              <button class="cancel" onclick="$('#iwanttopostblog').modal('hide');" type="button">CANCEL</button>
            </span>
        </div>
    </div>

    <!-- blog Image -->
    <div id="bloguploadimage" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <div style="padding-top: 25px;padding-bottom: 10px;">
                <h4 style="display: block;"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>  Upload Picture<a href="#" id="backuploadevent" onclick="$('#bloguploadimage').modal('hide');$('#iwanttopostblog').modal('show');"><i
                                class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
                </h4>
                <div style="padding-top: 10px;padding-bottom: 10px;">
                    <div style="text-align: center;padding-top: 10px;padding-bottom: 10px;">
              <span class="bloguploadimage">
                <img src="/images/photo.png" id="uploadBlogImage" class="img-thumbnail"><br>
              </span>
                        <!--  <i class="fas fa-search-plus"></i> Zoom -->
                    </div>
                </div>
            </div>
            <span>
                <input type="file" id="bloguploadphoto"
               onchange="document.getElementById('uploadBlogImage').src = window.URL.createObjectURL(this.files[0])" hidden
               name="regdocfile">
              <button class="continue" id="submitblogimage" type="button">COUNTINUE</button><br><br>
              <button class="btn btn-danger" style="width: 100%" id="skipblogimage" type="button">Skip</button><br><br>
              <button class="cancel" onclick="$('#bloguploadimage').modal('hide');" type="button">CANCEL</button>
            </span>
        </div>
    </div>

    <!-- blog Information -->
    <div id="bloginformation" class="modal">
         <div class="modal-content col-sm-9 col-md-6">
            <h5 style="font-weight: bold;"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>  Write Your Blog <a href="#" id="backabpotevent" onclick="$('#bloginformation').modal('hide');$('#bloguploadimage').modal('show');"><i
                            class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="raw">
                    <div class="col-sm-12 col-md-12">

                        <div class="form-group">
                            <textarea class="form-control" id="blog_information" name="content" rows="5"
                                      placeholder="Type your Event discription Here..."></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <span>
              <button class="continue" id="submitbloginfo" type="button">COUNTINUE</button><br><br>
              <button class="cancel" onclick="$('#bloginformation').modal('hide');" type="button">CANCEL</button>
            </span>
        </div>
    </div>


    <!-- blog free or paid -->
    <div id="blogfees" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>Is it FREE to join <a href="#" id="backfreejoin" onclick="$('#blogfees').modal('hide');$('#bloginformation').modal('show');"><i
                            class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="blogFeeType" id="blogfreeJoin" value="Free">Free
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="blogFeeType" id="blognotFreeJoin"
                               value="Not Free">Not Free &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="blogJoinType"
                                                                                                    style="display: none">$ <input
                                    type="text" id="blogFee" name=""></span>
                    </label>
                </div>
            </div>
            <span>
      <button class="continue" id="submitblogfees" type="button">COUNTINUE</button><br><br>
      <button class="cancel" onclick="$('#blogfees').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>

    <!-- Referal Commission -->
    <div id="blogrefferal" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                Will you provide referral comission <a href="#" id="backreffalcom"><i class="fa fa-arrow-circle-o-left"
                                                                                      style="font-size:48px;color:red;float: right"></i></a>
            </h5>
            <div style="padding-top: 10px;padding-bottom: 10px;">
                <span class="d-none float-right" style="padding: 8px;">
                    <p>Referral person </p>
                    <p>Perticipent <span id="blogbidWin">10 </span>%</p>
                  </span>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-share"></i></span>
                    </div>
                    <input type="text" placeholder="20" id="blogreferralPer" onchange="blogReferralOnchange()"
                           onkeypress="blogReferralMouseUp()" size="4">
                    <div class="input-group-append">
                        <span class="input-group-text">% Referral</span>
                    </div>
                </div>
                <div style="padding: 10px;">
                    If order any done by referral you will provide 15% service fee. From here referee will get <span id="blogrefPer">10 </span>%
                    <br>
                    else your service fee will be 20%
                </div>
            </div>
            <span>
      <button class="continue" id="submitblogrefferal" type="button">CONTINUE</button><br><br>
      <button class="cancel" onclick="$('#referralcomission').modal('hide');" type="button">CANCEL</button>
    </span>
        </div>
    </div>

    <!-- Blog Done -->
     <div id="postblogdone" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail"> Congrats! You're all
                done
                <!-- <a href="#" id="backeventfor"><i class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a> -->
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <br>
                <div>
                    <center>
                        <img src="{{asset('images/Taxic.png')}}" class="img-thumbnail">
                    </center>
                </div>
            </div>
            <span>
      <button class="continue" style="background: #a349a4" id="finalblogpreview" type="button">PREVIEW</button><br><br>
      <button class="continue" id="submitpostmore" type="button">POST MORE</button><br><br>
       <button class="cancel" onclick="$('#postbuydone').modal('hide');" type="button">CLOSE</button>
    </span>
        </div>
    </div>

    <div id="checkBlogReferral" class="modal">
        <div class="modal-content col-sm-9 col-md-4">
            <h5 style="font-weight: bold;"><img src="/images/eventLogo.png" style="height: 50px" class="img-thumbnail">
                Is There Any Referral to get discount 
            </h5>
            <div style="padding-top: 30px;padding-bottom: 30px;">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="blogreferralStatus" id="referralBlogYes" value="Yes">Yes
                    </label>&nbsp;&nbsp;&nbsp;
                    <label class="form-check-label">
                        <input type="text" class="form-control" name="" placeholder="Referral Email" id="enterBlogReferral" style="display: none">
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="blogreferralStatus" id="referralBlogNo" value="No">No
                    </label>
                </div>
            </div>
            <span>
              <button class="continue" id="submitBlogReferralYes" type="button">COUNTINUE</button><br><br>
              <button class="cancel" onclick="$('#checkReferral').modal('hide');" type="button">CANCEL</button>
            </span>
        </div>
    </div>

    <!-- Blog Design End -->


    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script type="text/javascript">
        //function changeGoing(id, goingStatus)
        function changeGoing(id) {
            $.ajax({
                type: 'post',
                url: '/events/goingStatusUpdate',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'Id': id,
                },
                success: function (data) {
                    if (data.goingstatus == 'going') {
                        $("#goingImage" + id).html('<img = src="/images/going.png"   style="width: 80px">');
                    } else {
                        $("#goingImage" + id).html('<img = src="/images/notgoing.png"   style="width: 80px">');
                    }

                }
            });
        }

        $(document).ready(function () {
            var today = new Date();

            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = mm + '/' + dd + '/' + yyyy;
            //  alert(today);
            $('#eventStartDate').datepicker({
                format: 'mm/dd/yyyy',
                startDate: today,
            });
            $('#eventEndDate').datepicker({
                format: 'mm/dd/yyyy',
                startDate: today,
            });
            $('#editeventStartDate').datepicker({
                format: 'mm/dd/yyyy',
                startDate: today,
            });
            $('#editeventEndDate').datepicker({
                format: 'mm/dd/yyyy',
                startDate: today,
            });

        });
    </script>
    <!-- End congratulation for event -->
    <!-- Take a photo for your post -->
</form>
@extends('layouts.app')
@section('custom-styles')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
   <div class="row bhoechie-tab-container">
      <div class=" col-3 bhoechie-tab-menu">
         <div class="list-group">
            <a href="#" class="list-group-item active text-center">
               <h3 class="fa fa-plane"></h3>
               <br/>Flights
            </a>
            <a href="#" class="list-group-item text-center">
               <h3 class="fa fa-building"></h3>
               <br/>Hotels
            </a>
            <a href="#" class="list-group-item text-center">
               <h3 class="fa fa-car"></h3>
               <br/>Cars
            </a>
            <a href="#" class="list-group-item text-center">
               <h3 class="fa fa-umbrella"></h3>
               <br/>Holidays
            </a>
            <a href="#" class="list-group-item text-center">
               <h3 class="fa fa-tasks"></h3>
               <br/>Things to do
            </a>
            <a href="#" class="list-group-item text-center">
               <h3 class="fa fa-ship"></h3>
               <br/>Ships
            </a>
            <a href="#" class="list-group-item text-center">
               <h3 class="fa fa-bus"></h3>
               <br/>Buses
            </a>
            <a href="#" class="list-group-item text-center">
               <h3 class="fa fa-train"></h3>
               <br/>Trains
            </a>
         </div>
      </div>
      <div class="col-9 bhoechie-tab">
         <!-- flight section -->
         <div class="bhoechie-tab-content active">
            <div class="bd-example bd-example-tabs">
               <nav class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-1st-tab" data-toggle="tab" href="#nav-1st" role="tab" aria-controls="home" aria-expanded="true">Round Trip</a>
               <a class="nav-item nav-link" id="nav-1st-tab" data-toggle="tab" href="#nav-2nd" role="tab" aria-controls="profile" aria-expanded="false">One Way</a>
               <a class="nav-item nav-link" id="nav-1st-tab" data-toggle="tab" href="#nav-3rd" role="tab" aria-controls="profile" aria-expanded="false">Multi City</a>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="nav-1st" role="tabpanel" aria-labelledby="nav-1st-tab" aria-expanded="true">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Fly From</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Origion city or airport" id="M1T1in1" aria-label="Username" aria-describedby="basic-addon1">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M1T1in1')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Fly To</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" id="M1T1in2" aria-describedby="basic-addon1">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M1T1in2')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Departing</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Returning</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row top-buffer">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Travelers</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend col-1">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-user"></i></span>
                                 </div>
                                 <div class="dropdown show col-11">
                                   <a class="btn dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <span id="M1T1A"> 1 </span> Adult, <span id="M1T1C"> 0 </span> Childern, <span id="M1T1Cls"> Economy</span>
                                   </a>

                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                     <form onsubmit="false">
                                      <ul class="list-group">
                                         <li class="list-group-item">Rooms 
                                          <span class="botton-setter"> 
                                             <button onclick="remove_room('M1T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T1Room">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_room('M1T1')"  class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                          </li>
                                         <li class="list-group-item">Adults
                                          <span class="botton-setter"> 
                                             <button onclick="remove_adults('M1T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T1Adcount">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_adults('M1T1')" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Childern (2-17 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_child('M1T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T1Childern">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_child('M1T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Infants (under 2 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_infant('M1T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T1Infants">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_infant('M1T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">
                                          <label class="con">Economy
                                            <input type="radio" value="Economy" checked="checked" name="M1T1Class" onchange="setClass(this.value,'M1T1Cls')">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">Premium Economy
                                            <input type="radio" onchange="setClass(this.value,'M1T1Cls')" value="Premium Economy" name="M1T1Class">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">Business
                                            <input type="radio" onchange="setClass(this.value,'M1T1Cls')" value="Business" name="M1T1Class">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">First Class
                                            <input type="radio" onchange="setClass(this.value,'M1T1Cls')" value="First Class" name="M1T1Class">
                                            <span class="checkmark"></span>
                                          </label>
                                         </li>
                                       </ul>
                                     </form>
                                   </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-2nd" role="tabpanel" aria-labelledby="nav-2nd-tab" aria-expanded="false">
                    <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Fly From</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Origion city or airport" aria-label="Username" id="M1T2in1" aria-describedby="basic-addon1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M1T2in1')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Fly To</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" id="M1T2in2" aria-describedby="basic-addon1">
                                  <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M1T2in2')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Departing</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        
                     </div>
                     <div class="row top-buffer">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Travelers</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend col-1">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-user"></i></span>
                                 </div>
                                 <div class="dropdown show col-11">
                                   <a class="btn dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <span id="M1T2A"> 1 </span> Adult, <span id="M1T2C"> 0 </span> Childern, <span id="M1T2Cls"> Economy</span>
                                   </a>

                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                     <form onsubmit="false">
                                      <ul class="list-group">
                                         <li class="list-group-item">Rooms 
                                          <span class="botton-setter"> 
                                             <button onclick="remove_room('M1T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T2Room">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_room('M1T2')"  class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                          </li>
                                         <li class="list-group-item">Adults
                                          <span class="botton-setter"> 
                                             <button onclick="remove_adults('M1T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T2Adcount">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_adults('M1T2')" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Childern (2-17 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_child('M1T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T2Childern">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_child('M1T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Infants (under 2 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_infant('M1T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M1T2Infants">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_infant('M1T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">
                                          <label class="con">Economy
                                            <input type="radio" value="Economy" checked="checked" name="M1T2Class" onchange="setClass(this.value,'M1T2Cls')">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">Premium Economy
                                            <input type="radio" onchange="setClass(this.value,'M1T2Cls')" value="Premium Economy" name="M1T2Class">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">Business
                                            <input type="radio" onchange="setClass(this.value,'M1T2Cls')" value="Business" name="M1T2Class">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">First Class
                                            <input type="radio" onchange="setClass(this.value,'M1T2Cls')" value="First Class" name="M1T2Class">
                                            <span class="checkmark"></span>
                                          </label>
                                         </li>
                                       </ul>
                                     </form>
                                   </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-3rd" role="tabpanel" aria-labelledby="nav-3rd-tab" aria-expanded="false">
                  <div id="repeatTHIS">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Fly From</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Origion city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Fly To</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Departing</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     </div>
                     <a onclick="repeat()">+Add another flight</a>
                  </div>
               </div>
            </div>
         </div>
         <!-- hotels section -->
         <div class="bhoechie-tab-content">
            <div class="row">
               <div class="input-setter col-md-10">
                  <div class='componentWrapper'>
                     <div class="header">Destination</div>
                     <div class="input-group input-inner-setter">
                        <div class="input-group-prepend">
                           <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Origion city or airport" aria-label="Username" aria-describedby="basic-addon1">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="input-setter col-md-5">
                  <div class='componentWrapper'>
                     <div class="header">Check-in</div>
                     <div class="input-group input-inner-setter">
                        <div class="input-group-prepend ">
                           <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                     </div>
                  </div>
               </div>
               <div class="input-setter col-md-5">
                  <div class='componentWrapper'>
                     <div class="header">Check-out</div>
                     <div class="input-group input-inner-setter">
                        <div class="input-group-prepend">
                           <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row top-buffer">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Travelers</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend col-1">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-user"></i></span>
                                 </div>
                                 <div class="dropdown show col-11">
                                   <a class="btn dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <span id="M2T1A"> 1 </span> Adult, <span id="M2T1C"> 0 </span> Childern, <span id="M2T1Cls"> Economy</span>
                                   </a>

                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                     <form onsubmit="false">
                                      <ul class="list-group">
                                         <li class="list-group-item">Rooms 
                                          <span class="botton-setter"> 
                                             <button onclick="remove_room('M2T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M2T1Room">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_room('M2T1')"  class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                          </li>
                                         <li class="list-group-item">Adults
                                          <span class="botton-setter"> 
                                             <button onclick="remove_adults('M2T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M2T1Adcount">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_adults('M2T1')" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Childern (2-17 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_child('M2T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M2T1Childern">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_child('M2T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Infants (under 2 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_infant('M2T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M2T1Infants">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_infant('M2T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">
                                          <label class="con">Economy
                                            <input type="radio" value="Economy" checked="checked" name="M2T1Class" onchange="setClass(this.value,'M2T1Cls')">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">Premium Economy
                                            <input type="radio" onchange="setClass(this.value,'M2T1Cls')" value="Premium Economy" name="M2T1Class">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">Business
                                            <input type="radio" onchange="setClass(this.value,'M2T1Cls')" value="Business" name="M2T1Class">
                                            <span class="checkmark"></span>
                                          </label>
                                          <label class="con">First Class
                                            <input type="radio" onchange="setClass(this.value,'M2T1Cls')" value="First Class" name="M2T1Class">
                                            <span class="checkmark"></span>
                                          </label>
                                         </li>
                                       </ul>
                                     </form>
                                   </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
            <div class="btn-search">
               <div class="input-group">
                  <input type="submit" class="form-control btn-success" value="SEARCH">
               </div>
            </div>
         </div>
         <!-- cars search -->
         <div class="bhoechie-tab-content">
            <div class="bd-example bd-example-tabs">
               <h6>BOOK A RIDE</h6>
               <nav class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-2nd-tab" data-toggle="tab" href="#point-to-point" role="tab" aria-controls="home" aria-expanded="true">POINT TO POINT</a>
               <a class="nav-item nav-link" id="nav-2nd-tab" data-toggle="tab" href="#rentals" role="tab" aria-controls="profile" aria-expanded="false">RENTALS</a>
               <a class="nav-item nav-link" id="nav-2nd-tab" data-toggle="tab" href="#self-drive" role="tab" aria-controls="profile" aria-expanded="false">SELF DRIVE</a>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="point-to-point" role="tabpanel" aria-labelledby="nav-2nd-tab" aria-expanded="true">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Pick-up location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Enter city, address" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Drop-off location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Enter city, address" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="RIDE NOW">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="rentals" role="tabpanel" aria-labelledby="nav-2nd-tab" aria-expanded="false">
                    <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="cabBooking" id="roundTrip" value="roundTrip" checked> ROUND TRIP </label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="cabBooking" id="onewayTrip" value="onewayTrip"> ONE WAY </label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="cabBooking" id="localTrip" value="localTrip"> LOCAL </label>
                          </div>
                          <hr>
                        </div>
                     </div>
                     <div id="roundTrip-tab">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Pick-up location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Drop-off location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Pick-up Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <!-- <div class="header">Pick-up Date</div> -->
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Return Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <!-- <div class="header">Pick-up Date</div> -->
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH CAB">
                        </div>
                     </div>
                     </div>
                     <div id="onewayTrip-tab">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Pick-up location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Drop-off location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Pick-up Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH CAB">
                        </div>
                     </div>
                     </div>
                     <div id="localTrip-tab">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Pick-up location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="localcabBooking" id="localHourly" value="hourly" checked>HOURLY</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="localcabBooking" id="localDaily" value="daily">DAILY</label>
                          </div>
                        </div>
                     </div>
                     <div id="localcabBooking-hourly-tab">
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Pick-up Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Rental Package</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Destination city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH CAB">
                        </div>
                     </div>
                     </div>
                     <div id="localcabBooking-daily-tab">
                        <div class="checkbox">
                           <label><input type="checkbox" value="">I only need a car for daily UP and DOWN</label>
                        </div>
                        <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Start Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">End Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH CAB">
                        </div>
                     </div>
                     </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="self-drive" role="tabpanel" aria-labelledby="nav-2nd-tab" aria-expanded="false">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Location</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Enter city, address" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Start Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">End Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="RIDE NOW">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Holidays -->
         <div class="bhoechie-tab-content">
            <div class="bd-example bd-example-tabs">
               <!-- <h6>BOOK A RIDE</h6> -->
               <nav class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-3rd-tab" data-toggle="tab" href="#groupTours" role="tab" aria-controls="home" aria-expanded="true">GROUP TOURS</a>
               <a class="nav-item nav-link" id="nav-3rd-tab" data-toggle="tab" href="#cruiseTours" role="tab" aria-controls="profile" aria-expanded="false">CRUISE TOURS</a>
               <a class="nav-item nav-link" id="nav-3rd-tab" data-toggle="tab" href="#familyTours" role="tab" aria-controls="profile" aria-expanded="false">FAMILY TOURS</a>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="groupTours" role="tabpanel" aria-labelledby="nav-3rd-tab" aria-expanded="true">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Origion city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Departure Month</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"></span>
                                 </div>
                                 <select class="form-control">
                                    <option>Month of Travel (Any)</option>
                                    <option>January 2019</option>
                                    <option>Febrauary 2019</option>
                                    <option>March 2019</option>
                                    <option>April 2019</option>
                                    <option>May 2019</option>
                                    <option>June 2019</option>
                                    <option>July 2019</option>
                                    <option>August 2019</option>
                                    <option>September 2019</option>
                                    <option>October 2019</option>
                                    <option>November 2019</option>
                                    <option>December 2019</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row top-buffer">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Travelers</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend col-1">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-user"></i></span>
                                 </div>
                                 <div class="dropdown show col-11">
                                   <a class="btn dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <span id="M4T1A"> 1 </span> Adult, <span id="M4T1C"> 0 </span> Childern
                                   </a>

                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                     <form onsubmit="false">
                                      <ul class="list-group">
                                         <li class="list-group-item">Rooms 
                                          <span class="botton-setter"> 
                                             <button onclick="remove_room('M4T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T1Room">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_room('M4T1')"  class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                          </li>
                                         <li class="list-group-item">Adults
                                          <span class="botton-setter"> 
                                             <button onclick="remove_adults('M4T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T1Adcount">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_adults('M4T1')" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Childern (2-17 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_child('M4T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T1Childern">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_child('M4T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Infants (under 2 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_infant('M4T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T1Infants">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_infant('M4T1')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         
                                       </ul>
                                     </form>
                                   </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH CRUISE">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="cruiseTours" role="tabpanel" aria-labelledby="nav-3rd-tab" aria-expanded="false">
                    <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Origion city or airport" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Departure Month</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"></span>
                                 </div>
                                 <select class="form-control">
                                    <option>Month of Travel (Any)</option>
                                    <option>January 2019</option>
                                    <option>Febrauary 2019</option>
                                    <option>March 2019</option>
                                    <option>April 2019</option>
                                    <option>May 2019</option>
                                    <option>June 2019</option>
                                    <option>July 2019</option>
                                    <option>August 2019</option>
                                    <option>September 2019</option>
                                    <option>October 2019</option>
                                    <option>November 2019</option>
                                    <option>December 2019</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row top-buffer">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Travelers</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend col-1">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-user"></i></span>
                                 </div>
                                 <div class="dropdown show col-11">
                                   <a class="btn dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <span id="M4T2A"> 1 </span> Adult, <span id="M4T2C"> 0 </span> Childern
                                   </a>

                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                     <form onsubmit="false">
                                      <ul class="list-group">
                                         <li class="list-group-item">Rooms 
                                          <span class="botton-setter"> 
                                             <button onclick="remove_room('M4T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T2Room">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_room('M4T2')"  class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                          </li>
                                         <li class="list-group-item">Adults
                                          <span class="botton-setter"> 
                                             <button onclick="remove_adults('M4T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T2Adcount">1</span>
                                             &nbsp;&nbsp;
                                             <button type="button" onclick="add_adults('M4T2')" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Childern (2-17 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_child('M4T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T2Childern">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_child('M4T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         <li class="list-group-item">Infants (under 2 yrs)
                                          <span class="botton-setter"> 
                                             <button onclick="remove_infant('M4T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-minus"></i></button> 
                                             &nbsp;&nbsp;
                                             <span id="M4T2Infants">0</span>
                                             &nbsp;&nbsp;
                                             <button onclick="add_infant('M4T2')" type="button" class="btn btn-default btn-round btn-sm"><i class="fas fa-plus"></i></button> 
                                          </span>
                                         </li>
                                         
                                       </ul>
                                     </form>
                                   </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH CRUISE">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="familyTours" role="tabpanel" aria-labelledby="nav-3rd-tab" aria-expanded="false">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going from</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Origion city or airport" aria-label="Username" id="M4T3in1" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M4T3in1')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Origion city or airport" aria-label="Username" id="M4T3in2" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M4T3in2')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Departure Month</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"></span>
                                 </div>
                                 <select class="form-control">
                                    <option>Month of Travel (Any)</option>
                                    <option>January 2019</option>
                                    <option>Febrauary 2019</option>
                                    <option>March 2019</option>
                                    <option>April 2019</option>
                                    <option>May 2019</option>
                                    <option>June 2019</option>
                                    <option>July 2019</option>
                                    <option>August 2019</option>
                                    <option>September 2019</option>
                                    <option>October 2019</option>
                                    <option>November 2019</option>
                                    <option>December 2019</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH TOUR">
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="bhoechie-tab-content">
            <div class="bd-example bd-example-tabs">
               <nav class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-4th-tab" data-toggle="tab" href="#todoMovies" role="tab" aria-controls="home" aria-expanded="true">MOVIES</a>
               <a class="nav-item nav-link" id="nav-4th-tab" data-toggle="tab" href="#todoEvents" role="tab" aria-controls="profile" aria-expanded="false">EVENTS</a>
               <a class="nav-item nav-link" id="nav-4th-tab" data-toggle="tab" href="#todoActivities" role="tab" aria-controls="profile" aria-expanded="false">ACTIVITIES</a>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="todoMovies" role="tabpanel" aria-labelledby="nav-4th-tab" aria-expanded="true">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Where</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1" list="location" id="M5T1in1">
                                 <datalist id="location">
                                  <option value="Use Your Location">
                                </datalist>
                                <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M5T1in1')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH MOVIES">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="todoEvents" role="tabpanel" aria-labelledby="nav-4th-tab" aria-expanded="false">
                    <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Where</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1" list="location" id="M5T2in1">
                                 <datalist id="location">
                                  <option value="Use Your Location">
                                </datalist>
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M5T2in1')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH MOVIES">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="todoActivities" role="tabpanel" aria-labelledby="nav-4th-tab" aria-expanded="false">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Where</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1" list="location" id="M5T3in1">
                                 <datalist id="location">
                                  <option value="Use Your Location">
                                </datalist>
                                <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M5T3in1')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Start Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">End Date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH MOVIES">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="bhoechie-tab-content">
            <div class="bd-example bd-example-tabs">
               <nav class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-5th-tab" data-toggle="tab" href="#bookshipTickets" role="tab" aria-controls="home" aria-expanded="true">BOOK SHIP TICKETS</a>
               <a class="nav-item nav-link" id="nav-5th-tab" data-toggle="tab" href="#hireBoats" role="tab" aria-controls="profile" aria-expanded="false">HIRE BOAT</a>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="bookshipTickets" role="tabpanel" aria-labelledby="nav-5th-tab" aria-expanded="true">
                     <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="bookShipRadio" id="shipRoundTrip" value="shipRoundTrip" checked>ROUND TRIP</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="bookShipRadio" id="shipOneWay" value="shipOneWay">ONE WAY</label>
                          </div>
                        </div>
                     </div>
                     <hr>
                     <div id="shipBooking-RoundTrip-tab">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Leaving from</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Enter City" aria-label="Username" id="M6T1in1" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T1in1')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Enter City" aria-label="Username" id="M6T1in2" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T1in2')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Depart date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Return date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH SHIPS">
                        </div>
                     </div>
                     </div>
                     <div id="shipBooking-OneWay-tab">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Leaving from</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" id="M6T2in1" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T2in1')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" id="M6T2in2" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T2in2')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Depart date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH SHIPS">
                        </div>
                     </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="hireBoats" role="tabpanel" aria-labelledby="nav-5th-tab" aria-expanded="false">
                    <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="hireBoatRadio" id="hireBoatRoundTrip" value="hireBoatRoundTrip" checked>ROUND TRIP</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="hireBoatRadio" id="hireBoatOneWay" value="hireBoatOneWay">ONE WAY</label>
                          </div>
                        </div>
                     </div>
                     <hr>
                     <div id="hireBoat-RoundTrip-tab">
                        <div class="row">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Starting point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" id="M6T3in1" aria-describedby="basic-addon1">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T3in1')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Ending point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" id="M6T3in2" aria-describedby="basic-addon1">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T3in2')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Start date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">End date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                 </div>
                                 <select class="form-control">
                                    <option>1:00 AM</option>
                                    <option>2:00 AM</option>
                                    <option>3:00 AM</option>
                                    <option>4:00 AM</option>
                                    <option>5:00 AM</option>
                                    <option>6:00 AM</option>
                                    <option>7:00 AM</option>
                                    <option>8:00 AM</option>
                                    <option>9:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 AM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="checkbox">
                        <label><input type="checkbox" name="boatRTMultipleCities" id="boatRTMultipleCities" value="">WANT TO TRAVEL MULTIPLE CITIES IN BETWEEN</label>
                     </div>
                     <div class="row" id="inbetweenCity">
                        <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">In between city</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                     </div>
                     <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Preference</div>
                              <nav class="nav nav-tabs nav-justified col-md-12" id="preferenceSection" role="tablist">
                              <a class="nav-item nav-link active" id="withAC" data-toggle="tab" role="tab" aria-controls="home" aria-expanded="true">A/C</a>
                              <a class="nav-item nav-link" id="withoutAC" data-toggle="tab"  role="tab" aria-controls="profile" aria-expanded="false">Non A/C</a>
                              </nav>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Travelers</div>
                              <div class="input-group">
                                <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field form-control">
                                <input type="button" value="-" class="btn btn-default button-minus" data-field="quantity">
                                <input type="button" value="+" class="btn btn-default button-plus" data-field="quantity">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search-ships-section">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH BOATS">
                        </div>
                     </div>
                     </div>
                     <div id="hireBoat-OneWay-tab">
                        <div class="row">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Starting point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" id="M6T4in1" aria-describedby="basic-addon1">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T4in1')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Ending point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" id="M6T4in2" aria-describedby="basic-addon1">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T4in2')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Start date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend ">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <select class="form-control">
                                       <option>1:00 AM</option>
                                       <option>2:00 AM</option>
                                       <option>3:00 AM</option>
                                       <option>4:00 AM</option>
                                       <option>5:00 AM</option>
                                       <option>6:00 AM</option>
                                       <option>7:00 AM</option>
                                       <option>8:00 AM</option>
                                       <option>9:00 AM</option>
                                       <option>10:00 AM</option>
                                       <option>11:00 AM</option>
                                       <option>12:00 AM</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">End date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend ">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <select class="form-control">
                                       <option>1:00 AM</option>
                                       <option>2:00 AM</option>
                                       <option>3:00 AM</option>
                                       <option>4:00 AM</option>
                                       <option>5:00 AM</option>
                                       <option>6:00 AM</option>
                                       <option>7:00 AM</option>
                                       <option>8:00 AM</option>
                                       <option>9:00 AM</option>
                                       <option>10:00 AM</option>
                                       <option>11:00 AM</option>
                                       <option>12:00 AM</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" name="boatOWMultipleCities" id="boatOWMultipleCities" value="">WANT TO TRAVEL MULTIPLE CITIES IN BETWEEN</label>
                        </div>
                        <div class="row" id="anOtherCityOW">
                        <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">In between city</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                     </div>
                        <div class="row">
                           <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="header">Preference</div>
                                 <nav class="nav nav-tabs nav-justified col-md-12" id="preferenceSection" role="tablist">
                                 <a class="nav-item nav-link active" id="withAC" data-toggle="tab" role="tab" aria-controls="home" aria-expanded="true">A/C</a>
                                 <a class="nav-item nav-link" id="withoutAC" data-toggle="tab"  role="tab" aria-controls="profile" aria-expanded="false">Non A/C</a>
                                 </nav>
                              </div>
                           </div>
                           <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="header">Travelers</div>
                                 <div class="input-group">
                                   <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field form-control">
                                   <input type="button" value="-" class="btn btn-default button-minus" data-field="quantity">
                                   <input type="button" value="+" class="btn btn-default button-plus" data-field="quantity">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn-search-ships-section">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH BOATS">
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="bhoechie-tab-content">
            <div class="bd-example bd-example-tabs">
               <nav class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-6th-tab" data-toggle="tab" href="#bookbusTickets" role="tab" aria-controls="home" aria-expanded="true">BOOK BUS TICKETS</a>
               <a class="nav-item nav-link" id="nav-6th-tab" data-toggle="tab" href="#hireCoach" role="tab" aria-controls="profile" aria-expanded="false">HIRE COACH</a>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="bookbusTickets" role="tabpanel" aria-labelledby="nav-6th-tab" aria-expanded="true">
                     <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="bookBusRadio" id="busRoundTrip" value="busRoundTrip" checked>ROUND TRIP</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="bookBusRadio" id="busOneWay" value="busOneWay">ONE WAY</label>
                          </div>
                        </div>
                     </div>
                     <hr>
                     <div id="bootBusRoundTripTab">
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Leaving from</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Enter City" aria-label="Username" id="M6T4in1" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T4in1')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="Enter City" aria-label="Username" id="M6T4in2" aria-describedby="basic-addon1">
                                 <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T4in2')"><i class="fa fa-times"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Depart date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH BUSES">
                        </div>
                     </div>
                     </div>
                     <div id="bootBusOneWayTab">
                        <div class="row">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Leaving from</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter City" aria-label="Username" id="M6T4in3" aria-describedby="basic-addon1">
                                     <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T4in3')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Going to</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter City" aria-label="Username" id="M6T4in4" aria-describedby="basic-addon1">
                                    <span class="input-group-text icon-setter clearInput" id="basic-addon1" onclick="clear_input('M6T4in4')"><i class="fa fa-times"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Depart date</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend ">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH BUSES">
                        </div>
                     </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="hireCoach" role="tabpanel" aria-labelledby="nav-6th-tab" aria-expanded="false">
                    <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="hireCoachRadio" id="hireCoachRoundTrip" value="hireCoachRoundTrip" checked>ROUND TRIP</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="hireCoachRadio" id="hireCoachOneWay" value="hireCoachOneWay">ONE WAY</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="hireCoachRadio" id="hireCoachLocal" value="hireCoachLocal">LOCAL</label>
                          </div>
                        </div>
                     </div>
                     <hr>
                     <div id="hireCoach-RT-Tab">
                        <div class="row">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Starting point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Ending point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Start date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend ">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <select class="form-control">
                                       <option>1:00 AM</option>
                                       <option>2:00 AM</option>
                                       <option>3:00 AM</option>
                                       <option>4:00 AM</option>
                                       <option>5:00 AM</option>
                                       <option>6:00 AM</option>
                                       <option>7:00 AM</option>
                                       <option>8:00 AM</option>
                                       <option>9:00 AM</option>
                                       <option>10:00 AM</option>
                                       <option>11:00 AM</option>
                                       <option>12:00 AM</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">End date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend ">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <select class="form-control">
                                       <option>1:00 AM</option>
                                       <option>2:00 AM</option>
                                       <option>3:00 AM</option>
                                       <option>4:00 AM</option>
                                       <option>5:00 AM</option>
                                       <option>6:00 AM</option>
                                       <option>7:00 AM</option>
                                       <option>8:00 AM</option>
                                       <option>9:00 AM</option>
                                       <option>10:00 AM</option>
                                       <option>11:00 AM</option>
                                       <option>12:00 AM</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" name="coachRTMultipleCities" id="coachRTMultipleCities" value="">WANT TO TRAVEL MULTIPLE CITIES IN BETWEEN</label>
                        </div>
                        <div class="row" id="inbetweenCityRT">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">In between city</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="header">Preference</div>
                                 <nav class="nav nav-tabs nav-justified col-md-12" id="preferenceSection" role="tablist">
                                 <a class="nav-item nav-link active" id="withAC" data-toggle="tab" role="tab" aria-controls="home" aria-expanded="true">A/C</a>
                                 <a class="nav-item nav-link" id="withoutAC" data-toggle="tab"  role="tab" aria-controls="profile" aria-expanded="false">Non A/C</a>
                                 </nav>
                              </div>
                           </div>
                           <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="header">Travelers</div>
                                 <div class="input-group">
                                   <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field form-control">
                                   <input type="button" value="-" class="btn btn-default button-minus" data-field="quantity">
                                   <input type="button" value="+" class="btn btn-default button-plus" data-field="quantity">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn-search-ships-section">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH COACHES">
                        </div>
                     </div>
                     </div>
                     <div id="hireCoach-OW-Tab">
                        <div class="row">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Starting point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Ending point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">Start date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend ">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <select class="form-control">
                                       <option>1:00 AM</option>
                                       <option>2:00 AM</option>
                                       <option>3:00 AM</option>
                                       <option>4:00 AM</option>
                                       <option>5:00 AM</option>
                                       <option>6:00 AM</option>
                                       <option>7:00 AM</option>
                                       <option>8:00 AM</option>
                                       <option>9:00 AM</option>
                                       <option>10:00 AM</option>
                                       <option>11:00 AM</option>
                                       <option>12:00 AM</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row" id="OW-MC-endDate">
                        <div class="input-setter col-md-5">
                           <div class='componentWrapper'>
                              <div class="header">End date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend ">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <select class="form-control">
                                       <option>1:00 AM</option>
                                       <option>2:00 AM</option>
                                       <option>3:00 AM</option>
                                       <option>4:00 AM</option>
                                       <option>5:00 AM</option>
                                       <option>6:00 AM</option>
                                       <option>7:00 AM</option>
                                       <option>8:00 AM</option>
                                       <option>9:00 AM</option>
                                       <option>10:00 AM</option>
                                       <option>11:00 AM</option>
                                       <option>12:00 AM</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" name="coachOWMultipleCities" id="coachOWMultipleCities" value="">WANT TO TRAVEL MULTIPLE CITIES IN BETWEEN</label>
                        </div>
                        <div class="row" id="inbetweenCityOW">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Another city</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="header">Preference</div>
                                 <nav class="nav nav-tabs nav-justified col-md-12" id="preferenceSection" role="tablist">
                                 <a class="nav-item nav-link active" id="withAC" data-toggle="tab" role="tab" aria-controls="home" aria-expanded="true">A/C</a>
                                 <a class="nav-item nav-link" id="withoutAC" data-toggle="tab"  role="tab" aria-controls="profile" aria-expanded="false">Non A/C</a>
                                 </nav>
                              </div>
                           </div>
                           <div class="input-setter col-md-5">
                              <div class='componentWrapper'>
                                 <div class="header">Travelers</div>
                                 <div class="input-group">
                                   <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field form-control">
                                   <input type="button" value="-" class="btn btn-default button-minus" data-field="quantity">
                                   <input type="button" value="+" class="btn btn-default button-plus" data-field="quantity">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn-search-ships-section">
                           <div class="input-group">
                              <input type="submit" class="form-control btn-success" value="SEARCH COACHES">
                           </div>
                        </div>
                     </div>
                     <div id="hireCoach-Local-Tab">
                        <div class="row" id="dailyStartingPoint">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Starting point</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row" id="monthlyLocation">
                           <div class="input-setter col-md-10">
                              <div class='componentWrapper'>
                                 <div class="header">Location</div>
                                 <div class="input-group input-inner-setter">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="input-setter col-md-10">
                             <div class="col-md-12">
                               <label class="col-md-3 radio-inline"> <input type="radio" name="hireCoachMDRadio" id="coachDaily" value="coachDaily" checked>DAILY</label>
                               <label class="col-md-3 radio-inline"> <input type="radio" name="hireCoachMDRadio" id="coachMonthly" value="coachMonthly">MONTHLY</label>
                             </div>
                           </div>
                        </div>
                        <div id="hireCoachDaily">
                           <div class="row">
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Pick-up date</div>
                                    <div class="input-group input-inner-setter">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                       </div>
                                       <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                 </div>
                              </div>
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="input-group input-inner-setter">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                       </div>
                                       <select class="form-control">
                                          <option>1:00 AM</option>
                                          <option>2:00 AM</option>
                                          <option>3:00 AM</option>
                                          <option>4:00 AM</option>
                                          <option>5:00 AM</option>
                                          <option>6:00 AM</option>
                                          <option>7:00 AM</option>
                                          <option>8:00 AM</option>
                                          <option>9:00 AM</option>
                                          <option>10:00 AM</option>
                                          <option>11:00 AM</option>
                                          <option>12:00 AM</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="input-setter col-md-10">
                                 <div class='componentWrapper'>
                                    <div class="header">Rental Package</div>
                                    <div class="input-group input-inner-setter">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                       </div>
                                       <select class="form-control">
                                          <option>1:00 AM</option>
                                          <option>2:00 AM</option>
                                          <option>3:00 AM</option>
                                          <option>4:00 AM</option>
                                          <option>5:00 AM</option>
                                          <option>6:00 AM</option>
                                          <option>7:00 AM</option>
                                          <option>8:00 AM</option>
                                          <option>9:00 AM</option>
                                          <option>10:00 AM</option>
                                          <option>11:00 AM</option>
                                          <option>12:00 AM</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Preference</div>
                                    <nav class="nav nav-tabs nav-justified col-md-12" id="preferenceSection" role="tablist">
                                    <a class="nav-item nav-link active" id="withAC" data-toggle="tab" role="tab" aria-controls="home" aria-expanded="true">A/C</a>
                                    <a class="nav-item nav-link" id="withoutAC" data-toggle="tab"  role="tab" aria-controls="profile" aria-expanded="false">Non A/C</a>
                                    </nav>
                                 </div>
                              </div>
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Travelers</div>
                                    <div class="input-group">
                                      <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field form-control">
                                      <input type="button" value="-" class="btn btn-default button-minus" data-field="quantity">
                                      <input type="button" value="+" class="btn btn-default button-plus" data-field="quantity">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="btn-search-ships-section">
                              <div class="input-group">
                                 <input type="submit" class="form-control btn-success" value="SEARCH COACHES">
                              </div>
                           </div>
                        </div>
                        <div id="hireCoachMonthly">
                           <div class="row">
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Start date</div>
                                    <div class="input-group input-inner-setter">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                       </div>
                                       <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                 </div>
                              </div>
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">End date</div>
                                    <div class="input-group input-inner-setter">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                       </div>
                                       <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="checkbox">
                              <label><input type="checkbox" name="" id="" value="" checked>WANT ONLY FOR UP AND DOWN</label>
                           </div>
                           <div class="row">
                              <div class="input-setter col-md-10">
                                 <div class='componentWrapper division'>
                                    <div class="header">Route</div>
                                    <div class="row">
                                       <div class="col-5">
                                       <div class="input-group input-inner-setter">
                                          <input type="text" id="routeFrom" class="form-control" placeholder="From" aria-label="Username" aria-describedby="basic-addon1">
                                       </div>
                                       </div>
                                       <div class="col-1">
                                          <button id="swapButton" class="btn btn-default btn-round"><i class="fas fa-exchange-alt"></i></button>
                                       </div>
                                       <div class="col-6">
                                       <div class="input-group input-inner-setter">
                                         <input type="text" id="routeTo" class="form-control" placeholder="To" aria-label="Username" aria-describedby="basic-addon1">
                                       </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Daily pick-up</div>
                                    <div class="input-group input-inner-setter">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                       </div>
                                       <select class="form-control">
                                          <option>1:00 AM</option>
                                          <option>2:00 AM</option>
                                          <option>3:00 AM</option>
                                          <option>4:00 AM</option>
                                          <option>5:00 AM</option>
                                          <option>6:00 AM</option>
                                          <option>7:00 AM</option>
                                          <option>8:00 AM</option>
                                          <option>9:00 AM</option>
                                          <option>10:00 AM</option>
                                          <option>11:00 AM</option>
                                          <option>12:00 AM</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Daily return</div>
                                    <div class="input-group input-inner-setter">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                       </div>
                                       <select class="form-control">
                                          <option>1:00 AM</option>
                                          <option>2:00 AM</option>
                                          <option>3:00 AM</option>
                                          <option>4:00 AM</option>
                                          <option>5:00 AM</option>
                                          <option>6:00 AM</option>
                                          <option>7:00 AM</option>
                                          <option>8:00 AM</option>
                                          <option>9:00 AM</option>
                                          <option>10:00 AM</option>
                                          <option>11:00 AM</option>
                                          <option>12:00 AM</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Preference</div>
                                    <nav class="nav nav-tabs nav-justified col-md-12" id="preferenceSection" role="tablist">
                                    <a class="nav-item nav-link active" id="withAC" data-toggle="tab" role="tab" aria-controls="home" aria-expanded="true">A/C</a>
                                    <a class="nav-item nav-link" id="withoutAC" data-toggle="tab"  role="tab" aria-controls="profile" aria-expanded="false">Non A/C</a>
                                    </nav>
                                 </div>
                              </div>
                              <div class="input-setter col-md-5">
                                 <div class='componentWrapper'>
                                    <div class="header">Travelers</div>
                                    <div class="input-group">
                                      <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field form-control">
                                      <input type="button" value="-" class="btn btn-default button-minus" data-field="quantity">
                                      <input type="button" value="+" class="btn btn-default button-plus" data-field="quantity">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="btn-search-ships-section">
                              <div class="input-group">
                                 <input type="submit" class="form-control btn-success" value="SEARCH COACHES">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="bhoechie-tab-content">
            <div class="bd-example bd-example-tabs">
               <nav class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-7th-tab" data-toggle="tab" href="#bookTrain" role="tab" aria-controls="home" aria-expanded="true">BOOK TRAIN TICKETS</a>
               <a class="nav-item nav-link" id="nav-7th-tab" data-toggle="tab" href="#metroRail" role="tab" aria-controls="profile" aria-expanded="false">METRORAIL RECHARGE</a>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="bookTrain" role="tabpanel" aria-labelledby="nav-7th-tab" aria-expanded="true">
                     <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="booktrainRadio" id="intercity" value="intercity" checked>INTERCITY</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="booktrainRadio" id="global" value="global">GLOBAL</label>
                          </div>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Leaving from</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Depart date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH TRAINS">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="metroRail" role="tabpanel" aria-labelledby="nav-7th-tab" aria-expanded="false">
                    <div class="row">
                        <div class="input-setter col-md-10">
                          <div class="col-md-12">
                            <label class="col-md-3 radio-inline"> <input type="radio" name="booktrainRadio" id="intercity" value="intercity" checked>INTERCITY</label>
                            <label class="col-md-3 radio-inline"> <input type="radio" name="booktrainRadio" id="global" value="global">GLOBAL</label>
                          </div>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Leaving from</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Going to</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                 </div>
                                 <input type="text" class="form-control" placeholder="City" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                        <div class="input-setter col-md-10">
                           <div class='componentWrapper'>
                              <div class="header">Depart date</div>
                              <div class="input-group input-inner-setter">
                                 <div class="input-group-prepend ">
                                    <span class="input-group-text icon-setter" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                 </div>
                                 <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-search">
                        <div class="input-group">
                           <input type="submit" class="form-control btn-success" value="SEARCH TRAINS">
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('extra-JS')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection

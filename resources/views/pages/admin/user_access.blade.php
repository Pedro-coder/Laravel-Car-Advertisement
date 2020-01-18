@extends('layouts.app')

@section('content')
 <style type="text/css">
    .user-access-div{
     margin: 0px 23px -48px 136px;
      height: 350px !important;
      width: 80% !important;
      background: #f7f7f7;
    }
    .custom-btn{
   padding: 10px 140px 10px 140px;
    border: 1px #bbbbbb solid;
    box-shadow: #eee 1px 1px;
    margin-top: 29px;
    margin-left: 376px;
    margin-bottom: 10px;
    display: inline-block;
    }
   
  </style>

<section id="userAccess" class="userAccess">
   <div class="card-header col-md-10 offset-md-1">
      
      <h5 class="card-title pt-2">User Access <a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a>
      </h5>
  </div>
  <div class="user-access-div">
    <img id="imgset" height="180px" width="180px" style="margin-left: auto;margin-right: auto;display: block;">
    <a id="prolink" href="#" class="custom-btn btn" >profile </a>
    
    <!--  <input type="text" placeholder="Search.." name="search" class="search-bar">
     <i class="fa fa-search"></i> -->
     <div class="form-group col-md-4 offset-md-4">
         <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
              </div>
              <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search">
              <div class="input-group-append">
                 <button class="btn btn-secondary" type="button" id="button-addon2">
                   <i class="fas fa-search"></i>
                 </button>
             </div>
        </div>
       
        <div id="tbod" style="z-index: 10;position: relative;background: #eee;" >

        </div>

    </div>
                       
  </div>
 
  <div class="container mt-5 mb-3">
    <div class="col-md-12 offset-md-0">
      <div class="card">
       <!--  -->
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-8 offset-md-5 align-items-center">

            </div>
            <div class="col-md-12"><hr></div>
            <div class="form-group col-md-6 mt-3">
              <div class="form-group row">
                  <div class="col-md-10 offset-md-1">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>
                          <input id="name" type="text" class="form-control" name="name" placeholder="Name" required>
                      </div>
                  </div>
              </div>
               <div class="form-group row">
                  <div class="col-md-10 offset-md-1">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="">
                                  <i class="fas fa-box"></i>
                              </span>
                          </div>
                          <input id="email" type="text" class="form-control" name="email" placeholder="Email" required>
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <div class="col-md-10 offset-md-1">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="">
                                  <i class="fas fa-unlock"></i>
                              </span>
                          </div>
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
                      </div>


                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>


              <div class="form-group row">
                  <div class="col-md-10 offset-md-1">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="">
                                  <i class="fas fa-unlock"></i>
                              </span>
                          </div>
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm password" required>
                      </div>

                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-10 offset-md-1">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="">
                                  <i class="fas fa-map-marker-alt"></i>
                              </span>
                          </div>
                          <input id="location" type="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location') }}" placeholder="Location" required>

                      </div>

                      @if ($errors->has('location'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('location') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-10 offset-md-1">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="">
                                  <i class="fas fa-phone"></i>
                              </span>
                          </div>
                          <input id="phone_no" type="phone_no" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{ old('phone_no') }}" placeholder="Phone" required>

                      </div>

                      @if ($errors->has('phone_no'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phone_no') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-10 offset-md-1">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="">
                                  <i class="fab fa-paypal"></i>
                              </span>
                          </div>
                          <input id="paypal_email" type="paypal_email" class="form-control{{ $errors->has('paypal_email') ? ' is-invalid' : '' }}" name="paypal_email" value="{{ old('paypal_email') }}" placeholder="PayPal Email" required>

                      </div>

                      @if ($errors->has('paypal_email'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('paypal_email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

            </div>
            <div class="form-group col-md-6 mt-3">
             <!--  <div class="form-group col-md-10 offset-md-1">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                   <button class="btn btn-secondary" type="button" id="button-addon2">
                     <i class="fas fa-search"></i>
                   </button>
                 </div>
               </div>
              </div> -->
              <div class="input-group col-md-10 offset-md-1">
                <div class="input-group mb-3">
                  <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option value="1">Active User</option>
                    <option value="2">User Under Review</option>
                    <option value="3">Block for Dues</option>
                    <option value="4">Block for Dispute</option>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-10 offset-md-1">
                <a onClick=create_user(2); style="color:white" class="btn btn-primary btn-block" id="without_id">CREATE ID WITHOUT VERIFICATION</a>
              </div>
              <div class="form-group col-md-10 offset-md-1">
                <a onClick=create_user(1); style="color:white" class="btn btn-primary btn-block" id="with_id">CREATE ID WITH VERIFICATION</a>
              </div>
              <div class="form-group col-md-10 offset-md-1">
                <a href="#" class="btn btn-primary btn-block">EDIT PROFILE</a>
              </div>
              <div class="form-group col-md-10 offset-md-1">
                <a href="#" class="btn btn-danger btn-block">DELETE PROFILE</a>
              </div>
              <div class="form-group col-md-10 offset-md-1 mt-2">
                <button type="submit" class="btn btn-success btn-block float-right">
                    {{ __('Save') }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('extra-JS')
<script>
$("body").click
(
  function(e)
  {
    if(e.target.className !== "suggession_box")
    {
      $(".suggession_box").hide();
    }
  }
);
</script>
<script type="text/javascript">

  $('#search').on('keyup',function()
  {
  
    $value=$(this).val();
  
    $.ajax({
  
      type : 'get',

       url : '{{URL::to('user_access_search')}}',

       data:{'search':$value},

       success:function(data){

        $('#tbod').html(data);
         $('#tbod').show();

       }

    });

  })
        
 </script>
 <script type="text/javascript">
   function setImageLink(id){
    console.log(id);
    $.ajax({
      type:'get',
      url:'{{URL::to('get_user_image_and_link')}}',
      data:{'id':id},
      success:function(src){
        console.log(src);
        $('#tbod').hide();
        $('#name').val(src.name);
        $('#email').val(src.email);
        $('#paypal_email').val(src.paypal_email);
        var img = document.getElementById('imgset');
         img.src = src.src;
         $("#prolink").attr("href", src.link);
         if(src.verify_status==0){
            //  $('#without_id').attr('style','disable');
            //   $('#with_id').attr('style','disable');
         }else
         {
             // $('#with_id').attr('style','disable');
             
         }
        
        

      }

    });
   }
 </script>
 <script type="text/javascript">
   
   function create_user(flag){
    var password=$('#password').val();
    var name=$('#name').val();
    var location=$('#location').val();
    var phone=$('#phone_no').val();
    var paypal_email=$('#paypal_email').val();
     var email=$('#email').val();

    if(flag==1){
      $.notify("Account Has been created. Check Email for varification","info");
      $.ajax({
        type:'get',
        url:'{{URL::to('create_user_with_verification')}}',
        data:{'name':name,'password':password,'location':location,'phone':phone,'paypal_email':paypal_email,'email':email},
        success:function(data){
          console.log(data);
        }
      });
    }
    if(flag==2){
      $.ajax({
        type:'get',
        url:'{{URL::to('create_user_without_verification')}}',
        data:{'name':name,'password':password,'location':location,'phone':phone,'paypal_email':paypal_email,'email':email},
        success:function(data){
          console.log(data);
           $.notify("Account Has been created without Email verification","info");
           
        }
      });
    }

   }
 </script>
@endsection

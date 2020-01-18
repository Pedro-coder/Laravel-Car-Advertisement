@extends('layouts.app')

@section('content')
<section id="admin" class="admin-panel">
  <div class="container mt-5 mb-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title pt-2">Admin Panel <a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a></h5>
         
        </div>
        <div class="card-body">
          <form id="user_manu_add">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
          <div class="form-row">
            <div class="form-group col-md-8 offset-md-5 align-items-center">
              <img id="user_avatar_img" src="{{ asset('/uploads/avatars/' . $user->avatar) }}"
              style="width:100px; height:100px; float:left; border-radius:50%;">
            </div>
            <div class="form-group col-md-10 offset-md-1 mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input class="form-control" id="find_email" name="find_email" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                 <button class="btn btn-secondary search_user" type="button" id="button-addon2">
                   <i class="fas fa-search"></i>
                 </button>
               </div>
             </div>
            </div>
            <?php foreach ($menu_options as $menu_option){ ?>
            <div class="input-group col-md-10 offset-md-1">
              <label for="checkbox" class="form-control"><a href="{{ url($menu_option->link) }}"><?php echo $menu_option->name; ?></a></label>
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="checkbox" value="<?php echo $menu_option->id; ?>" name="menu_options[]" aria-label="Checkbox for following text input">
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="form-group col-md-10 offset-md-1 mt-2">
              <button type="submit" class="btn btn-success float-right">
                  {{ __('Save') }}
              </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
 
@endsection

@section('extra-JS')
  <script>
    $(document).ready(function(){
      $('.search_user').on('click', function(){
       
        $.ajax({
          url: "{{url('/findmenu_options')}}",
          type: "GET",
          data:{
            email: $("#find_email").val(),
          },
          success: function (msg) {
             console.log('ami');
            if(msg != 1){
              $('#user_manu_add :input[type="checkbox"]').removeAttr("checked");
              var obj = jQuery.parseJSON( msg );
              for(var i=0; i<=obj[1].length-1; i++){
                $('#user_manu_add :input[value="'+obj[1][i]+'"]').attr('checked', 'checked');
              }
              $("#user_avatar_img").attr('src', '/uploads/avatars/'+obj[0].avatar);
              jQuery.notify(obj[0].name+ " Found in record", "success");
            }else {
              $('#user_manu_add :input[type="checkbox"]').removeAttr("checked");
              jQuery.notify("User Not Found in record", "success");
            }
          },
          error: function (data) {
          }
        });
      });
      $('#user_manu_add').on('submit', function(e){
        
        e.preventDefault();
        
        $.ajax({
          url: "{{url('/add_user_menu')}}",
          type: "POST",
          data: $('#user_manu_add').serialize(),
          success: function (msg) {
            
            if(msg == 1){
              $.notify("Permissions Granted", "success");
              console.log(msg);
              //$('#find_email').val("");
              //$('#user_manu_add :input[type="checkbox"]').removeAttr("checked");
            }
          },
          error: function (data) {
          }
        });
      });
    });
  </script>
@endsection

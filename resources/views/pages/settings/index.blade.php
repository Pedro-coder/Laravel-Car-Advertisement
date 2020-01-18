@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
        Payment Receiver
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/settings/update-email') }}">
            <div class="form-group">
                <div class="row">
               <label for="paypal_email" class="col-md-2"><img src="{{ URL::asset('images/paypal_image.png') }}" style="height: 50px;" /></label>
               <div class="col-md-10">
                   <input type="text" class="form-control paypel-input" id="paypal_email" placeholder="Enter Paypal Email" name="email_id" value="{{ $setting->paypal_email ?? '' }}">
               </div>
               <label for="client_id" class="col-md-2">Paypal Client Id</label>
               <div class="col-md-10">
                   <input type="text" class="form-control paypel-input" id="client_id" placeholder="Enter Paypal Client Id" name="client_id" value="{{ $setting->paypal_client_id ?? '' }}">
               </div>
               <br>
               <br>
               <br>
               <label for="client_secret" class="col-md-2">Paypal Client Secret</label>
               <div class="col-md-10">
                   <input type="text" class="form-control paypel-input" id="client_secret" placeholder="Enter Paypal Client Secret" name="client_secret" value="{{ $setting->paypal_secret_id ?? '' }}">
               </div>
               </div>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <br>
    <br>
    <div class="card">
        <div class="card-header">
        Email Sender
        </div>
        <div class="card-body">
         <form method="POST" action="{{ url('settings/env') }}">
            <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" placeholder="Enter email" name="mail_username" value="{{ $setting->mail_username ?? '' }}">
            </div>
            <div class="form-group">
               <label for="password">Password</label>
               <input type="text" class="form-control" id="password" placeholder="Password" name="mail_password" value="{{ $setting->mail_password ?? '' }}">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
         </form>
        </div>
    </div>
    <br>
    <br>
   <div class="card">
      <div class="card-header">
         Pusher Credentials
      </div>
      <div class="card-body">
         <form method="POST" action="{{ url('settings/env') }}">
            <div class="form-group">
               <label for="PUSHER_APP_ID">APP_ID</label>
               <input type="text" class="form-control" id="PUSHER_APP_ID" placeholder="Enter APP_ID" name="pusher_app_id" value="{{ $setting->pusher_app_id ?? '' }}">
            </div>
            <div class="form-group">
               <label for="PUSHER_APP_KEY">APP_KEY</label>
               <input type="text" class="form-control" id="PUSHER_APP_KEY" placeholder="Enter APP_KEY" name="pusher_app_key" value="{{ $setting->pusher_app_key ?? '' }}">
            </div>
            <div class="form-group">
               <label for="PUSHER_APP_SECRET">APP_SECRET</label>
               <input type="text" class="form-control" id="PUSHER_APP_SECRET" placeholder="Enter APP_SECRET" name="pusher_app_secret" value="{{ $setting->pusher_app_secret ?? '' }}">
            </div>
            <div class="form-group">
               <label for="PUSHER_APP_CLUSTER">APP_CLUSTER</label>
               <input type="text" class="form-control" id="PUSHER_APP_CLUSTER" placeholder="Enter APP_CLUSTER" name="pusher_app_cluster" value="{{ $setting->pusher_app_cluster ?? '' }}">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
         </form>
      </div>
   </div>
   <br><br>
   <div class="card">
      <div class="card-header">
         Upload file size
      </div>
      <div class="card-body">
         <form method="POST" action="{{ url('settings/env') }}">
            <div class="form-group">
               <!-- <label for="file_size">Email</label> -->
               <input type="text" class="form-control" id="file_size" placeholder="Enter file size" name="file_size" value="{{ $setting->file_size ?? '' }} kb">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
         </form>
      </div>
   </div>
   <br><br>
   <div class="card">
      <div class="card-header">
         About us
      </div>
      <div class="card-body">
         <form method="POST" action="{{ url('settings/env') }}">
            <div class="form-group">
               <!-- <label for="about">Email</label> -->
               <!-- <input type="text" class="form-control" id="about" placeholder="Enter about..." name="about" value="{{ $setting->about ?? '' }}"> -->
               <textarea class="form-control form-control-lg " id="editor" name="about" rows="8">{{ $setting->about ?? '' }}</textarea>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
         </form>
      </div>
   </div>
   <br><br>
   <div class="card">
      <div class="card-header">
         Post Category
      </div>
      <div class="card-body">
         <div>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th scope='col'>Category</th>
                     <th scope='col'>Type</th>
                     <th scope='col'>Post name</th>
                     <th scope='col'>Actions</th>
                  </tr>
               </thead>
               @foreach($postCats as $postcat)
               <tbody>
                  <tr>
                     <td>{{$postcat->main_category}}</td>
                     <td>{{$postcat->category}}</td>
                     <td>{{$postcat->post}} </td>
                     <td>
                        <button class="btn btn-info" onclick="edit({{json_encode($postcat)}})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteFun({{json_encode($postcat)}})" >X</button>
                     </td>
                  </tr>
               </tbody>
               @endforeach
            </table>
            <div class="form-group">
               <div class="form-check">
                  <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="cat" id="buy" value="Buy" onClick="onChecked(this.value)">
                  Buy
                  </label>
               </div>
               <div class="form-check">
                  <label class="form-check-label">
                  <input class="form-check-input" type="radio" onClick="onChecked(this.value)"  name="cat" id="sell" value="Sell">
                  Sell
                  </label>
               </div>
               <div class="form-check">
                  <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="cat" id="blog" value="Blog" onClick="onChecked(this.value)">
                  Blog
                  </label>
               </div>
               <div class="form-check">
                  <label class="form-check-label">
                  <input class="form-check-input" type="radio" onClick="onChecked(this.value)"  name="cat" id="event" value="Event">
                  Event
                  </label>
               </div>
            </div>
            <form id="postCatForm" method="POST" action=" {{ url('postcategory') }}">
               <div class="form mt-2">
                  <div class="form-row align-items-center form-group">
                     <div class="col-auto">
                        <input type="hidden" name="catId" id="catId">
                        <input type="text" class="form-control mb-4 mb-sm-0" name="category" placeholder="Category" id="category" readonly>
                     </div>
                     <div class="col-auto" id="sub_cat">
                        <div class="input-group mb-4 mb-sm-0">
                           <input type="text" class="form-control" name="sub_category" placeholder="Type" id="input1">
                        </div>
                     </div>
                     <div class="col-auto">
                        <div class="input-group mb-4 mb-sm-0">
                           <input type="text" class="form-control" name="postName" placeholder="Post Name" id="input2">
                        </div>
                     </div>
                  </div>
               </div>
               {{ csrf_field() }}
               <button type="submit" class="btn btn-primary" id="btn-add">Add</button>
               <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
            </form>
         </div>
      </div>
   </div>
   
   <br>
   <br>
   
    <div class="card">
        <div class="card-header">
        Display Style
        </div>
        <div class="card-body">
         <form method="POST" action="{{ url('settings/display') }}">
           
            <div class="form-group">
               <div class="form-check">
                  <label class="form-check-label">
                  <input class="form-check-input" type="radio" <?php echo $setting->view_style == 'pinterest' ? 'checked="checked"' : ''?> name="display" id="pinterest" value="pinterest" >
                  Pinterest Style
                  </label>
               </div>
               <div class="form-check">
                  <label class="form-check-label">
                  <input class="form-check-input" type="radio" <?php echo $setting->view_style == 'facebook' ? 'checked="checked"' : ''?>  name="display" id="facebook" value="facebook">
                  Facebook Style
                  </label>
               </div>
            </div>
           
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
         </form>
        </div>
    </div>
</div>
<script>
   function onChecked(val){
       document.getElementById('category').value = val;
       if(val == 'Event' || val == 'Blog')
       {
          document.getElementById("sub_cat").style.display = "none";
       }
       else
       {
          document.getElementById("sub_cat").style.display = "block";
       }
   }
   
   function edit(val){
       document.getElementById("postCatForm").method = "put";
       document.getElementById('catId').value = val.id;
       document.getElementById('category').value = val.main_category;
       document.getElementById('input1').value = val.category;
       document.getElementById('input2').value = val.post;
   }
   function deleteFun(val)
   {
      if(confirm('Are you sure you want to delete this record !'))
      {
        $.ajax({
           url: '/postcategory/'+val.id,
           type: 'get',
           success: function (response) {
              if(!alert('Post Delete Successfully')){window.location.reload();}
           }
       }); 
      }
       
   }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="https://pixlcore.com/demos/webcamjs/webcam.min.js"></script>
@endsection
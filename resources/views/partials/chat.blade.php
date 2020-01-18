<script>
      $(document).ready(function(){
         $.ajax({
            type:'get',
            url:'{{url('/getmessagepopup')}}',

            success:function(data){
                console.log(data);
                $('#messagepop').html(data);
                $('.ketamoti').hide();

            }
        });
      }) ;

        function messagepo(data){
           var data1='m'+data;
           var imgdata='msgimg'+data;
           var onlyimg='i'+data;
           console.log(data);
           console.log(imgdata);
             $('#'+data1).show(1000);
             $('#cross'+data).hide();


        }
        function messagepo2(data){
             var data1='m'+data;
              $('#'+data1).hide(1000);
              $('#cross'+data).show(1010);
        }
       function messagecross(data){
           var imgdata='msgimg'+data;
            $('#'+imgdata).hide(1000);
           $.ajax({
                type:'get',
                data:{'messagecrossid':data},
                url:'{{url('/getmessagepopup')}}',

                success:function(data){
                    console.log(data);
                    $('#messagepop').html(data);
                    $('.ketamoti').hide();

                }
          });
        }


</script>
<script src="{{ asset('newjs/app.js') }}"></script>
 <script>

   <?php
        if(!isset(Auth::user()->id))
            $a=null;
        else
             $a=Auth::user()->id;
   ?>
   var loginuser = "<?php echo $a;?>";

     window.Echo.private('messagesent-'+ loginuser)
     .listen('Messagesent',e=>{
        console.log('ssdasfas');
        console.log(e);
        var m=e.messageid;
        $.ajax({
            type:'get',
            data:{'echomessageid':m},
            url:'{{url('/getmessagepopup')}}',

            success:function(data){
                console.log(data);
                $('#messagepop').html(data);
                 $('.ketamoti').hide();

            }
        })
     });



</script>

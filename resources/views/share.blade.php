<html>
    <head>
        <title>Event</title>
         <meta property="og:url" content="http://3pdigital.in/share/{{ $data_array->id }}/{{$data_array->user_id}}" />
        <meta property="og:type" content="website" />
        <?php
        $currDate = date('m/d/Y');
        $getEventDateSavePost = App\EventModal::where('event_date', ">=", $currDate)->where('event_id', $data_array->id)->get()->first();
        ?>
        <meta property="og:title" content="{{ $data_array->event_title }}"/>
        <meta property="og:description" content="Event Fee: {{ $data_array->event_fee }}, Event Date: {{ date('M j, Y', strtotime($getEventDateSavePost->event_date)) }}" />
         <?php
        if(empty($data_array->event_modal_image))
        {
            ?>
                <meta property="og:image" content="{{ asset('/images/image_not_found.jpg')}}" />
            <?php
        }
        else
        {
            ?>
                <meta property="og:image" content="{{ asset('/uploads/event/')}}/{{ $data_array->event_modal_image }}" />
            <?php
        }
        ?>
        
        <meta property="og:image:width" content="450"/>
        <meta property="og:image:height" content="298"/>
    </head>
<body>
</body>
</html>
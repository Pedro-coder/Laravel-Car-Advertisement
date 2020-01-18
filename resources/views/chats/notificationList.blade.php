@if(count($notification) > 0)
    @foreach($notification as $message)

        <div style="color: red">Amount of INR. @if($message->withdraw == '') 0 @else {{ $message->withdraw }} @endif has been {{ $message->details }} on {{ $message->datwise }}</div>
    @endforeach
@endif
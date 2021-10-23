<a class="dropdown-item" href="{{ route('shop.show', $notification->data['product']['slug']) }}" role="button" onclick="function userpost() {

    $.get('{{route('markread',$notification->id)}}');
}
userpost()" data-arg1="{{$notification->data['user']['name']}}">{{$notification->data['user']['name']}} posted a new product </a>
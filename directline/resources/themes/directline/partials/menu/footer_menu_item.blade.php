 @if($menu->user_can_access)
 <li><a href="{{ url($menu->url) }}">{{ $menu->name }}</a></li>
 @endif
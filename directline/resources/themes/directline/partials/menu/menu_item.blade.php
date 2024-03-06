
@if($menu->hasChildren('active')  && $menu->user_can_access)

    <li class="{{ \Request::is(explode(',',$menu->active_menu_url))?'active':'' }} {{ $menu->hasChildren('active')?'nav-item dropdown':'' }}">
              <a href="{{ url($menu->url) }}" class="nav-link  " data-toggle="dropdown" data-hover="dropdown" >
            <span class="dropdown-toggle"> {{ $menu->name }}</span>
              </a>
              @if($menu->photo)

                <ul class="sub-menu dropdown-menu menu-products ">
                 <img src="{{$menu->photo}}" >
                 @foreach($menu->getChildren('active') as $submenu)
                    <li><a href="{{ url($submenu->url) }}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{{$submenu->name}}</a>
                         <img src="{{$submenu->photo}}" >

                    </li>
                    @endforeach
              </ul>

           

              @else

                <ul class="sub-menu dropdown-menu">
                @foreach($menu->getChildren('active') as $submenu)
                    <li><a href="{{ url($submenu->url) }}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{{$submenu->name}}</a></li>
                    @endforeach
              </ul>
              @endif

            </li>

   
@elseif($menu->user_can_access)
     <li class="{{ \Request::is(explode(',',$menu->active_menu_url))?'active':'' }}">
              <a href="{{ url($menu->url) }}" target="{{ $menu->target??'_self' }}">
                     <span>@if($menu->icon)<i class="{{ $menu->icon }} fa-fw"></i>@endif {{ $menu->name }}</span>
                </a>
            </li>

@endif


          
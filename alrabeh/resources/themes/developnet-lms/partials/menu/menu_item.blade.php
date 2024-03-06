@foreach($menus as $menu)
@if($menu->hasChildren('active') && $menu->user_can_access)
     <li class="nav-item {{ \Request::is(explode(',',$menu->active_menu_url))?'active':'' }} {{ $menu->isRoot()?'':'dropdown' }}">
         <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
             @if($menu->icon)<i class="{{ $menu->icon }} fa-fw"></i>@endif {{ $menu->name }}
                                    
        </a>

         <div class="dropdown-menu">
            @foreach($menu->getChildren('active') as $subMenu)

                 <div class="dropdown-item {{$subMenu->hasChildren('active')? 'nested':''}} ">
                     <a  href="{{$subMenu->url}}">{{$subMenu->name}}</a>
                        @if($subMenu->hasChildren('active')) {{-- neasted-1 --}}
                            <div class="nested-menu">
                                @foreach($subMenu->getChildren('active') as $nested_1)

                                <div class="dropdown-item {{$nested_1->hasChildren('active')? 'nested-2':''}}">
                                   <a  href="{{$nested_1->url}}">{{$nested_1->name}}</a>
                           @if($nested_1->hasChildren('active')) 
                            <div class="nested-menu-2">
                                @foreach($nested_1->getChildren('active') as $nested_2)
                               
                                <div class="dropdown-item {{$nested_2->hasChildren('active')? 'nested-3':''}}">
                                   <a  href="{{$nested_2->url}}">{{$nested_2->name}}</a>
                                </div> 
                                @endforeach
                            </div>
                            @endif

                                </div> 
                                @endforeach
                            </div>
                            @endif

                    </div> 
              @endforeach               
    </div>
     
     </li>
 @elseif($menu->user_can_access)
     <li class="nav-item {{ \Request::is(explode(',',$menu->active_menu_url))?'active':'' }}">
         <a class="nav-link" href="{{ url($menu->url) }}" target="{{ $menu->target??'_self' }}">
             <span>@if($menu->icon)<i class="{{ $menu->icon }} fa-fw"></i>@endif {{ $menu->name}}</span>
         </a>
     </li>
 @endif
@endforeach
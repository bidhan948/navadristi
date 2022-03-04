   <!-- !:: Navbar -->
   <nav>
       <div class="container">
           <div class="navigation">
               <ul class="menu">
                   <div class="close-btn"></div>
                   @foreach ($menus as $menu)
                       @if ($menu->slug == 'specialities')
                           <li class="menu-item">
                               <a class="sub-btn @yield('is_active_'.$menu->slug)" href="{{ url($menu->slug) }}">
                                   {{ $menu->title }}<i class="fa-solid fa-angle-down px-1"></i></a>
                               <ul class="sub-menu">
                                   @foreach ($menu->Page as $page)
                                       <li class="sub-item">
                                           <a href="{{ route('speciality.slug', $page->slug) }}"> {{ $page->title }}
                                           </a>
                                       </li>
                                   @endforeach
                               </ul>
                           </li>
                       @else
                           <li class="menu-item">
                               <a class="text-capitalize @yield('is_active_'.$menu->slug)"
                                   href="{{ url($menu->slug === 'home' ? '/' : $menu->slug) }}"> {{ $menu->title }}
                               </a>
                           </li>
                       @endif
                   @endforeach
               </ul>
           </div>
           <div class="menu-btn"></div>
       </div>
   </nav>

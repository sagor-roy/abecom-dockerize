<!-- end:: Aside -->
<!-- begin:: Aside Menu -->
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
        data-ktmenu-dropdown-timeout="500">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item " aria-haspopup="true">
                <a href="{{ route('dashboard') }}" class="kt-menu__link ">
                    <span class="kt-menu__link-icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="kt-menu__link-text">Dashboard</span>
                </a>
            </li>

            <!-- dropdown nav start -->
            @if( auth('web')->user()->is_admin == true )
                @foreach (App\Models\Menu::orderBy('position', 'asc')->get() as $menu)
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover">
                    <a href="{{  $menu->url ? $menu->url : "javascript:;" }}" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="{{ $menu->icon }}"></i>
                        </span>
                        <span class="kt-menu__link-text">{{ $menu->name }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    @if ($menu->sub_menu->count() > 0)
                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">

                                 @foreach( $menu->sub_menu->where("is_active", true) as $sub_menu )
                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="{{ route($sub_menu->url) }}" class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ $sub_menu->name }}</span><span
                                            class="kt-menu__link-badge"></span></a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    @endif
                </li>
                @endforeach
            @else
                @php
                    $menus = [];
                    foreach( auth('web')->user()->role as $role ){
                        foreach( $role->menu as $role_menu ){
                            $count = 0;
                            if( $menus ){
                                foreach( $menus as $array_menu ){
                                    if( $array_menu['id'] == $role_menu['id'] ){
                                        ++$count;
                                    }
                                }
                                if( $count == 0 ){
                                    array_push($menus, $role_menu);
                                }
                            }else{
                                array_push($menus, $role_menu);
                            }
                        }
                    }
                @endphp
                
                @foreach ($menus as $menu)
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover">
                    <a href="{{  $menu->url ? $menu->url : "javascript:;" }}" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="{{ $menu->icon }}"></i>
                        </span>
                        <span class="kt-menu__link-text">{{ $menu->name }}</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    @if ($menu->sub_menu->count() > 0)
                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">

                                 @foreach( $menu->sub_menu->where("is_active", true) as $sub_menu )
                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="{{ route($sub_menu->url) }}" class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">{{ $sub_menu->name }}</span><span
                                            class="kt-menu__link-badge"></span></a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    @endif
                </li>
                @endforeach
            @endif
            
            <!-- dropdown nav end -->




        </ul>
    </div>
</div>
<!-- end:: Aside Menu -->

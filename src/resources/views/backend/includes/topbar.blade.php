<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">
  <!--begin: User Bar -->
  <div class="kt-header__topbar-item kt-header__topbar-item--user">
     <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
        <div class="kt-header__topbar-user">
           <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
           <span class="kt-header__topbar-username kt-hidden-mobile">{{ auth('web')->user()->name }}</span>
           <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />
           <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
           <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ strtoupper(auth('web')->user()->name[0]) }}</span>
        </div>
     </div>
     <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

         <!--begin: Navigation -->
         <div class="kt-notification">
             <a href="{{ route('profile.show', auth('web')->user()->email ) }}" class="kt-notification__item">
                 <div class="kt-notification__item-icon">
                     <i class="flaticon2-calendar-3 kt-font-success"></i>
                 </div>
                 <div class="kt-notification__item-details">
                     <div class="kt-notification__item-title kt-font-bold">
                     My Profile
                     </div>
                 </div>
             </a>
             
             <div class="kt-notification__custom kt-space-between">
                 <a class="btn btn-label btn-label-brand btn-sm btn-bold" onclick="document.getElementById('logout').click()">Sign Out</a>
                 <form action="{{ route('do.logout') }}" method="post">
                  @csrf
                  <button type="submit" class="d-none" id="logout"></button>
                </form>
             </div>
         </div>
         <!--end: Navigation -->
     </div>
  </div>
  <!--end: User Bar -->	
</div>
<!-- end:: Header Topbar -->
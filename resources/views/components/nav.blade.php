 <!--  BEGIN NAVBAR  -->
 <div class="header-container">
     <header class="header navbar navbar-expand-sm">

         <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-menu">
                 <line x1="3" y1="12" x2="21" y2="12"></line>
                 <line x1="3" y1="6" x2="21" y2="6"></line>
                 <line x1="3" y1="18" x2="21" y2="18"></line>
             </svg>
         </a>

         <div class="nav-logo align-self-center">
             <a class="navbar-brand" href="{{ url('/') }}">
                 @if (auth()->user()->companySession)
                     <img alt="logo" class="img-fluid" height="100"
                         src="{{ asset('img') . '/' . auth()->user()->companySession->image }}">
                     <span class="navbar-brand-name">COTIZADOR {{ auth()->user()->companySession->name }}</span>
                 @else
                     <span class="navbar-brand-name">Administrador</span>
                 @endif
             </a>
         </div>

         <ul class="navbar-item flex-row mr-auto">

         </ul>

         <ul class="navbar-item flex-row nav-dropdowns">
             <li class="nav-item dropdown notification-dropdown">
                 <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-bell">
                         <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                         <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                     </svg><span class="badge badge-success"></span>
                 </a>
                 <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="notificationDropdown">
                     <div class="notification-scroll">

                         <div class="dropdown-item">
                             <div class="media server-log">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-server">
                                     <rect x="2" y="2" width="20" height="8" rx="2"
                                         ry="2"></rect>
                                     <rect x="2" y="14" width="20" height="8" rx="2"
                                         ry="2"></rect>
                                     <line x1="6" y1="6" x2="6" y2="6"></line>
                                     <line x1="6" y1="18" x2="6" y2="18"></line>
                                 </svg>
                                 <div class="media-body">
                                     <div class="data-info">
                                         <h6 class="">Server Rebooted</h6>
                                         <p class="">45 min ago</p>
                                     </div>

                                     <div class="icon-status">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-x">
                                             <line x1="18" y1="6" x2="6" y2="18">
                                             </line>
                                             <line x1="6" y1="6" x2="18" y2="18">
                                             </line>
                                         </svg>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="dropdown-item">
                             <div class="media ">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                     <path
                                         d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                     </path>
                                 </svg>
                                 <div class="media-body">
                                     <div class="data-info">
                                         <h6 class="">Licence Expiring Soon</h6>
                                         <p class="">8 hrs ago</p>
                                     </div>

                                     <div class="icon-status">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-x">
                                             <line x1="18" y1="6" x2="6" y2="18">
                                             </line>
                                             <line x1="6" y1="6" x2="18" y2="18">
                                             </line>
                                         </svg>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="dropdown-item">
                             <div class="media file-upload">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-file-text">
                                     <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                     <polyline points="14 2 14 8 20 8"></polyline>
                                     <line x1="16" y1="13" x2="8" y2="13"></line>
                                     <line x1="16" y1="17" x2="8" y2="17"></line>
                                     <polyline points="10 9 9 9 8 9"></polyline>
                                 </svg>
                                 <div class="media-body">
                                     <div class="data-info">
                                         <h6 class="">Kelly Portfolio.pdf</h6>
                                         <p class="">670 kb</p>
                                     </div>

                                     <div class="icon-status">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-check">
                                             <polyline points="20 6 9 17 4 12"></polyline>
                                         </svg>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </li>

             <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                 <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <div class="media">
                         <img src="{{ asset('assets/img/90x90.jpg') }}" class="img-fluid" alt="admin-profile">
                         <div class="media-body align-self-center">
                             <h6><span>Hola,</span> {{ auth()->user()->name }}</h6>
                         </div>
                     </div>
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-chevron-down">
                         <polyline points="6 9 12 15 18 9"></polyline>
                     </svg>
                 </a>
                 <div class="dropdown-menu position-absolute animated fadeInUp"
                     aria-labelledby="user-profile-dropdown">
                     <div class="">
                         {{-- <div class="dropdown-item">
                             <a class="" href="user_profile.html"><svg xmlns="http://www.w3.org/2000/svg"
                                     width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-user">
                                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                     <circle cx="12" cy="7" r="4"></circle>
                                 </svg> My Profile</a>
                         </div> --}}
                         <div class="dropdown-item">
                             <a class="" href="{{ url("/") }}">Ir a Home</a>
                         </div>
                     </div>
                 </div>

             </li>
         </ul>
     </header>
 </div>
 <!--  END NAVBAR  -->

 @php
     use App\Models\Template;

     $pages = Template::activeStatus()->parentOne()->ordered()->get();
 @endphp
 <div class="app-menu navbar-menu">
     <!-- LOGO -->
     {{-- <div class="navbar-brand-box p-2">
              <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center justify-content-center">
                  <h3 class="text-scheme mb-0">{{ label('Visobotics') }}</h3>
              </a>
              <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                  id="vertical-hover">
                  <i class="ri-record-circle-line"></i>
              </button>
          </div> --}}

     <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href={{ route('dashboard') }} class="logo logo-dark">
             <span class="logo-sm">
                 <img src="{{ asset('img/favicon.svg') }}" alt="" height="22">
             </span>
             <span class="logo-lg pt-4">
                 <h3 class="pt-2" style="color: white;">
                     {{ label('Visobotics') }}
                 </h3>
             </span>
         </a>
         <!-- Light Logo-->
         <a href={{ route('dashboard') }} class="logo logo-light">
             <span class="logo-sm">
                 <img src="{{ asset('img/favicon.svg') }}"alt="" height="22">
             </span>
             <span class="logo-lg pt-4">
                 <h3 class="pt-2" style="color: white;">
                     {{ label('Visobotics') }}
                 </h3>
             </span>
         </a>
         <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
             id="vertical-hover">
             <i class="ri-record-circle-line"></i>
         </button>
     </div>


     <div id="scrollbar">
         <div class="container-fluid">

             <div id="two-column-menu">
             </div>
             <ul class="navbar-nav" id="navbar-nav">

                 {{-- Dashboard --}}
                 <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-menu">Dashboard</span></li>
                 @php $route = 'dashboard'; @endphp
                 <li class="nav-item">
                     <a class="nav-link menu-link {{ Request::routeIs($route) ? 'active' : '' }}"
                         href="{{ route($route) }}">
                         <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboard">Dashboard</span>
                     </a>
                 </li>

                 {{-- Content Types --}}
                 <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-types">Content Types</span>
                 </li>
                 @can('articles.index')
                     @php $route = 'articles.index'; @endphp
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ Request::routeIs($route) ? 'active' : '' }}"
                             href="{{ route($route) }}">
                             <i class="ri-newspaper-line"></i> <span data-key="t-articles">Articles</span>
                         </a>
                     </li>
                 @endcan
                 @can('countries.index')
                     @php $route = 'countries.index'; @endphp
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ Request::routeIs($route) ? 'active' : '' }}"
                             href="{{ route($route) }}">
                             <i class="ri-flag-line"></i> <span data-key="t-country">Country</span>
                         </a>
                     </li>
                 @endcan
                 @can('coachings.index')
                     @php $route = 'coachings.index'; @endphp
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ Request::routeIs($route) ? 'active' : '' }}"
                             href="{{ route($route) }}">
                             <i class="ri-medal-line"></i> <span data-key="t-coaching">Coaching</span>
                         </a>
                     </li>
                 @endcan
                 @can('testimonials.index')
                     @php $route = 'testimonials.index'; @endphp
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ Request::routeIs($route) ? 'active' : '' }}"
                             href="{{ route($route) }}">
                             <i class="ri-chat-quote-line"></i> <span data-key="t-testimonial">Testimonial</span>
                         </a>
                     </li>
                 @endcan
                 @can('blogs.index')
                     @php $route = 'blogs.index'; @endphp
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ Request::routeIs($route) ? 'active' : '' }}"
                             href="{{ route($route) }}">
                             <i class="ri-edit-2-line"></i> <span data-key="t-blogs">Blog</span>
                         </a>
                     </li>
                 @endcan

                 {{-- System Management --}}
                 <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-system">System
                         Management</span></li>
                 @can('settings.edit')
                     @php $route = 'settings.edit'; @endphp
                     <li class="nav-item">
                         <a class="nav-link menu-link {{ Request::is('mappers*') ? 'active' : '' }}"
                             href="{{ route($route) }}">
                             <i class="ri-pen-nib-line"></i> <span data-key="t-mapper">Setting</span>
                         </a>
                     </li>
                 @endcan

             </ul>

         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>



<header>
    <div class="header_sub_content">
        <!-- search bar for clicking search icon start  -->

        <!-- search bar for clicking search icon end  -->
        <div class="row align--center">
            <div class="col-6">
                <div class="d-flex align-items-center">
                  <div class="custom-tooltip-container position-relative me-3">
                    <div class="d-flex align-items-center">
                        <i onclick="showSideBar()" class="fs-4 text--dark las la-bars pointer show-bar-icon text--indigo"></i>
                    </div>
                  </div>

                  <div class="custom-tooltip-container position-relative me-3">
                    <div class="d-flex align-items-center">
                        <i id="openFullScreen" onclick="openFull()" class="las la-arrows-alt fs-4 text--dark pointer"></i>
                        <i id="closeFullScreen" onclick="closeFull()" class="las la-compress fs-4 text--dark pointer"></i>
                        <div class="custom-tooltip">
                            <span>{{ decode('Full Screen') }}</span>
                        </div>
                    </div>
                  </div>

                  <div class="custom-tooltip-container position-relative me-3">
                    <div class="d-flex align-items-center">

                        <a href="{{ route('admin.settings.optimize.clear') }}">  <i class="las la-broom fs-4 text--dark pointer"></i> </a>

                      <div class="custom-tooltip">
                          <span><a href="{{ route('admin.settings.optimize.clear') }}">{{ decode('Clean Cache') }}</a></span>
                      </div>
                    </div>
                  </div>

                  <div class="bg-transparent  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="custom-tooltip-container position-relative me-3">
                    <div class="d-flex align-items-center">
                      <i class="las la-plus fs-4 text--dark pointer"></i>
                      <div class="custom-tooltip">
                          <span>{{ decode('Add New') }}</span>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            <div class="col-6">
                <div class="profile_notification">
                    <ul>
                        <li class="pointer">
                            @php
                                $systemLangCode = session()->get('locale');
                         
                                $defaultLang = getSystemLanguage()->where('code',$systemLangCode)->first();
                                if(!$defaultLang){
                                    $defaultLang = getSystemLanguage()->where('is_default',1)->first();
                                    $systemLangCode = $defaultLang->code;
                                }
                            @endphp
                            <div id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="language-container d-flex align-items-center">
                                <div class="flag me-sm-0 me-lg-2">
                                    <img src="{{ displayImage('assets/images/general/flags/'.strtoupper($defaultLang->code).'.png','25x20') }}" alt="" class="w-100 h-100">
                                </div>
                                <span class="hide_small">{{($defaultLang->name)}}</span>
                            </div>

                            <ul class="border-0 dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton1">
                                @foreach(getSystemLanguage()->where('code','!=',$systemLangCode) as $language)
                                    <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('change.language',$language->code) }}">
                                        <div class="flag me-1">
                                            <img src="{{ displayImage('assets/images/general/flags/'.strtoupper($language->code).'.png','25x20') }}" alt="" class="w-100 h-100">
                                        </div>
                                        <span>{{($language->name)}}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>


                        <li class="notification_main hide_small">
                            <a href="#" class="dropdown-toggle text--dark" id="dropdownMenuButton2"
                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="fs--7 las la-bell"></i></a>
                            <!-- alert for notification animation start  -->
                            @if(count(authUser()->unreadNotifications) > 0)
                            <div class="alert_badge">
                                <div class="alertt"></div>
                            </div>
                            @endif
                            <!-- alert for notification animation end  -->
                            <!-- dropdown item for notification icon start  -->
                            <div class="notification_sub dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <div class="dropdown_arrow"></div>
                                <div class="notification_sub_heading">
                                    <h6>{{decode('Notification')}}</h6>
                                    <p>{{decode('You have Total')}} ({{count(authUser()->unreadNotifications ) }}) {{decode('Unread notification')}}</p>
                                </div>
                                <ul>
                                  @foreach(authUser()->unreadNotifications as $notification)
                                    <li class="notification-read" data-id = "{{$notification->id }}" data-route='{{$notification->data['route'] }}'>
                                        <a href="#" class="dropdown-item">
                                            <div class="d--flex">
                                                <div class="notification_text ms-2">
                                                    <h6>
                                                        {{$notification->data['message'] }}
                                                    </h6>
                                                    <p class="notification_time">
                                                        <i class="las la-clock me-1"></i>@if ($notification->created_at->toDateString() == Carbon\Carbon::today()->toDateString())
                                                        {{  date('h:i A', strtotime($notification->created_at->format('g:i A'))) }}
                                                        @else
                                                        {{date("F j ",strtotime($notification->created_at )) }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                   @endforeach
                                </ul>

                                <div class="view_all_notification">
                                    <p>View all notification</p>
                                </div>
                            </div>
                            <!-- dropdown item for notification icon start  -->
                        </li>
                        <li class="drop-down">
                            <div class="dropdown-toggle d--flex align--center" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="userImage">
                                    <img src="{{displayImage('assets/images/admin/admin_profile/'.authUser()->profile_image, App\Cp\ImageProcessor::filePath()['admin_profile']['size'])}}" alt="" class="w-100 h-100" />
                                </div>
                                <p style="cursor: pointer" class="ms-1 hide_small">
                                    {{ authUser()->name }}
                                </p>
                            </div>
                            <!-- drop down menu for profile icon start  -->
                            <ul class="dropdown-menu drop_down_width" aria-labelledby="dropdownMenuButton1">

                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i
                                            class="me-1 lar la-user"></i>{{ decode('profile') }}</a>
                                </li>

                                <li>
                                    <a onclick="event.preventDefault();
                                    document.getElementById('admin-logout-form').submit();"  class="dropdown-item" href="{{ route('admin.logout') }}"><i class="me-1 las la-sign-in-alt"></i>Logout</a>
                                </li>
                            </ul>

                            <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="newLoader loader-progress"></div>
    </div>
</header>

<div id="sideContent" class="side_content">

    <div onclick="showSideBar()" class="cross pointer">
      <i class="las la-angle-left text-light fs--7"></i>
    </div>

    <div class="logo_container">
      <div class="logo_name">
        <div class="logo_img">
          <a  href="{{route('user.dashboard')}}" ><img src="{{displayImage('assets/images/general/weblogo/'.$generalSetting->logo, App\Cp\ImageProcessor::filePath()['logo']['size'])}}" alt="logo" /></a>
        </div>
      </div>
    </div>


    <div class="side_bar_menu_container">
      <div class="side_bar_menu_list">

        <!-- dashboard section start -->
        <ul>
            <li class="d--flex align--center">
                <a data-target="user/dashboard" class="ms--1 d--flex align--center pages" href="{{route('user.dashboard')}}">
                    <div>
                        <span class="me-3"><i class="fs-5 las la-home text-dark"></i></span><span>{{decode('Dashboard')}}</span>
                    </div>
                </a>
            </li>
        </ul>
        <!-- dashboard section end -->

        <!-- service log section end -->
        <span class="mb-1">{{decode('Package List')}}</span>
        <ul>
            <li>
                <a title="package list" class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                    <div>
                        <span class="me-3"><i class="fs-5 las la-shipping-fast"></i></span><span>{{decode('Package')}}</span>
                    </div>
                    <i class="las la-angle-down"></i>
                </a>
                <ul>
                    <li class="d--flex align--center">
                        <a data-target="user/package" class="fw-light pages" href="{{route('user.package.index')}}">
                            <i class="far fa-dot-circle me-3"></i>{{ decode('Packages') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- service section end -->

         <ul>
            <li class="d--flex align--center">
                <a data-target="user/purchase/log" class="ms--1 d--flex align--center pages" href="{{route('user.purchase.log.index')}}">
                    <div>
                        <span class="me-3"><i class="fs-5 las la-home text-dark"></i></span><span>{{decode('Purchase Log')}}</span>
                    </div>
                </a>
            </li>
        </ul>

        <!-- support section start -->
        <span class="mb-1">{{decode('Support')}}</span>
        <ul>
            <li class="d--flex align--center">
                <a data-target="user/support/ticket" class="ms--1 d--flex align--center pages" href="{{route('user.support.ticket.index')}}">
                    <div>
                        <span class="me-3"><i class="far fa-question-circle"></i></span><span>{{ decode('Support Ticket') }}</span>
                    </div>
                </a>
            </li>
        </ul>
        <!-- support section end -->

        

        <!-- user logout start -->
        <ul>
            <li class="d--flex align--center">
                <a class="ms--1 d--flex align--center" onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();" href="javascript:void(0)">
                <div>
                    <span class="me-3"><i class="fs-5 las la-sign-out-alt me-2"></i></span><span>Logout</span>
                </div>
                </a>
                <form id="user-logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- user logout end -->


      </div>
    </div>

    <div class="version-container">
      <span>version</span><span class="ms-1">1.1</span>
      <span class="d-block text-secondary">{{ $generalSetting->copy_right_text }}</span>
    </div>
    
  </div>
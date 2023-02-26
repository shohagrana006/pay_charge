@php
    $authUser = authUser();
@endphp

<div id="sideContent" class="side_content">
    <div onclick="showSideBar()" class="cross pointer">
      <i class="las la-angle-left text-light fs--7"></i>
    </div>
    <div class="logo_container">
      <div class="logo_name">
        <div class="logo_img">
          <a  href="{{route('admin.home')}}" ><img src="{{displayImage('assets/images/general/weblogo/'.$generalSetting->logo, App\Cp\ImageProcessor::filePath()['logo']['size'])}}" alt="logo" /></a>
        </div>
      </div>
    </div>
    <div class="side_bar_menu_container">
      <div class="side_bar_menu_list">

        <!-- dashboard section start -->
        @if ($authUser->can('dashboard.index'))
            <ul>
                <li class="d--flex align--center">
                    <a data-target="admin/dashboard" class="ms--1 d--flex align--center pages" href="{{route('admin.home')}}">
                        <div>
                            <span class="me-3"><i class="fs-5 las la-home text-dark"></i></span><span>{{decode('Dashboard')}}</span>
                        </div>
                    </a>
                </li>
            </ul>
        @endif
        <!-- dashboard section end -->



        <!-- country section start -->
        @if ($authUser->can('country.index'))
        <span class="mb-1">{{decode('Country')}}</span>
            <ul>
                <li class="d--flex align--center">
                    <a data-target="admin/country/index" class="ms--1 d--flex align--center pages" href="{{route('admin.country.index')}}">
                        <div>
                            <span class="me-3"><i class="fs-5 las la-map-marker"></i></span><span>{{ decode('Country') }}</span>
                        </div>
                    </a>
                </li>
            </ul>
        @endif
        <!-- country section end -->

        <!-- service log section end -->
        @if ($authUser->can('service.category.index') || $authUser->can('service.index'))
            <span class="mb-1">{{decode('Service')}}</span>
            <ul>
                <li>
                    <a title="manage service" class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                        <div>
                            <span class="me-3"><i class="fs-5 las la-shipping-fast"></i></span><span>{{decode('Manage Service')}}</span>
                        </div>
                        <i class="las la-angle-down"></i>
                    </a>
                    <ul>
                        @if ($authUser->can('service.category.index'))
                            <li class="d--flex align--center">
                                <a data-target="admin/service/category/index" class="fw-light pages" href="{{route('admin.service.category.index')}}">
                                    <i class="far fa-dot-circle me-3"></i>{{ decode('Category') }}
                                </a>
                            </li>
                        @endif
                        @if ($authUser->can('service.index'))
                            <li class="d--flex align--center">
                                <a data-target="admin/service/index" class="fw-light pages" href="{{route('admin.service.index')}}">
                                    <i class="far fa-dot-circle me-3"></i>{{ decode('Service') }}
                                </a>
                            </li>
                        @endif
                        @if ($authUser->can('purchase.log.index'))
                            <li class="d--flex align--center">
                                <a data-target="admin/purchase/log/index" class="fw-light pages" href="{{route('admin.purchase.log.index')}}">
                                    <i class="far fa-dot-circle me-3"></i>{{ decode('Purchase Log') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif
        <!-- service section end -->
              
         <!-- package section start -->
        @if ($authUser->can('package.index') || $authUser->can('package.list.index'))
            <span class="mb-1">{{ decode('Package') }}</span>
            <ul>
                <li>
                    <a title="manage package" class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                        <div>
                            <span class="me-3"><i class="fs-5 las la-box"></i></span><span>{{decode('Manage Package')}}</span>
                        </div>
                        <i class="las la-angle-down"></i>
                    </a>
                    <ul>
                        @if ($authUser->can('package.index'))
                            <li class="d--flex align--center">
                                <a data-target="admin/package/index" class="fw-light pages" href="{{route('admin.package.index')}}">
                                    <i class="far fa-dot-circle me-3"></i>{{ decode('Package') }}
                                </a>
                            </li>
                        @endif

                        @if ($authUser->can('package.list.index'))
                            <li class="d--flex align--center">
                                <a data-target="/admin/package/list/details" class="fw-light pages" href="{{route('admin.package.list.details')}}">
                                    <i class="far fa-dot-circle me-3"></i>{{ decode('Package Details') }}
                                </a>
                            </li>
                            <li class="d--flex align--center">
                                <a data-target="/admin/package/list/index" class="fw-light pages" href="{{route('admin.package.list.index')}}">
                                    <i class="far fa-dot-circle me-3"></i>{{ decode('Package List') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif
        <!-- package section end -->



        <span class="mb-1">{{ decode('Manage Admin & User') }}</span>
        <!-- manage  admin -->
        @if ($authUser->can('admin.index') || $authUser->can('role.index'))
            <ul>
                <li>
                    <a title="manage admin" class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                        <div>
                            <span class="me-3"><i class="las la-users-cog text--dark fs-5"></i></span><span>{{decode('Manage Admin')}}</span>
                        </div>
                        <i class="las la-angle-down"></i>
                    </a>
                    <ul>
                        @if ($authUser->can('admin.index'))
                            <li >
                                <a data-target="admin/index" class="fw-light pages" href="{{ route('admin.index') }}">
                                <i class="far fa-dot-circle me-3"></i>{{decode('Admin')}}</a>
                            </li>
                        @endif
                        @if ($authUser->can('role.index'))
                            <li >
                                <a data-target="admin/roles/index" class=" fw-light pages" href="{{route('admin.roles.index')}}">
                                <i class="far fa-dot-circle me-3"></i>{{decode('Roles')}}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        @endif
        <!-- manage  admin -->

        <!-- manage user start -->
        @if ($authUser->can('user.index'))
            <ul>
                <li >
                    <a class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                        <div>
                            <span class="me-3"><i class="fs-5 las la-users text--dark"></i></span><span>Manage Users</span>
                        </div>
                        <i class="las la-angle-down"></i>
                    </a>
                    @if ($authUser->can('user.index'))
                        <ul>
                            <li >
                                <a data-target="admin/user/index" class="fw-light pages" href="{{route('admin.user.index')}}"><i class="far fa-dot-circle me-3"></i>Users</a>
                            </li>
                        </ul>
                    @endif
                </li>
            </ul>
        @endif
        <!-- manage user end  -->



        <!-- language menu section start  -->
        @if ($authUser->can('language.index'))
            <span class="mb-1">{{ decode('Manage Language') }}</span>
            <ul>
                <li class="d--flex align--center">
                    <a data-target="/admin/language/index" class="ms--1 d--flex align--center pages" href="{{route('admin.language.index')}}">
                        <div>
                        <span class="me-3"><i class="las la-flag fs-5"></i></span><span>Language</span>
                        </div>
                        <p></p>
                    </a>
                </li>
            </ul>
        @endif
        <!-- language menu  section end  -->

        <!-- payment gateway start-->
        <span class="mb-1">{{ decode('Manage Payment Gateway') }}</span>
        <ul>
            <li>
                <a title="Manage Payment Gateway" class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                    <div>
                        <span class="me-3"><i class="fs-5 las la-credit-card"></i></span><span>{{decode('Payment Gateway')}}</span>
                    </div>
                    <i class="las la-angle-down"></i>
                </a>
                <ul>
                    @if($authUser->can('paymentMethod.index'))
                        <li >
                            <a data-target="admin/settings/payment/automatic" class="fw-light pages" href="{{route('admin.settings.payment')}}">
                            <i class="far fa-dot-circle me-3"></i>{{decode('Automatic Gateway')}}</a>
                        </li>
                    @endif
                    @if($authUser->can('payment.manual.index'))
                        <li >
                            <a data-target="/admin/payment/manual/index" class=" fw-light pages" href="{{route('admin.payment.manual.index')}}">
                            <i class="far fa-dot-circle me-3"></i>{{ decode('Manual Gateway') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
        <!-- payment gateway end-->



        <span class="mb-1">{{ decode('Why Choose & FAQ') }}</span>
        <!-- Why choose section start  -->
        @if($authUser->can('choose.index'))          
            <ul>
                <li class="d--flex align--center">
                    <a data-target="/admin/choose/index" class="ms--1 d--flex align--center pages" href="{{route('admin.choose.index')}}">
                        <div>
                            <span class="me-3"><i class="las fs-5 la-cubes"></i></span><span>{{ decode('Why Choose') }}</span>
                        </div>
                        <p></p>
                    </a>
                </li>
            </ul>
        @endif
        <!-- why choose section end  -->

        <!-- faq section start  -->
        @if($authUser->can('faq.index'))
            <ul>
                <li class="d--flex align--center">
                    <a data-target="/admin/faq/index" class="ms--1 d--flex align--center pages" href="{{route('admin.faq.index')}}">
                        <div>
                            <span class="me-3"><i class="fs-5 las la-question-circle"></i></i></span><span>{{ decode('FAQ') }}</span>
                        </div>
                        <p></p>
                    </a>
                </li>
            </ul>
        @endif
        <!-- faq section end  -->


        <!-- support ticket start-->
        @if($authUser->can('ticket.index'))
        <span class="mb-1">{{ decode('Ticket') }}</span>
        <ul>
            <li>
                <a title="support ticket" class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                    <div>
                        <span class="me-3"><i class="fs-5 las la-credit-card"></i></span><span>{{decode('Support Ticket')}}</span>
                    </div>
                    <i class="las la-angle-down"></i>
                </a>
                <ul>
                    <li >
                        <a data-target="admin/support/ticket/index" class="fw-light pages" href="{{route('admin.support.ticket.index')}}">
                        <i class="far fa-dot-circle me-3"></i>{{decode('All Ticket')}}</a>
                    </li>
                    <li >
                        <a data-target="admin/support/ticket/running" class="fw-light pages" href="{{route('admin.support.ticket.running')}}">
                        <i class="far fa-dot-circle me-3"></i>{{decode('Running Ticket')}}</a>
                    </li>
                    <li >
                        <a data-target="admin/support/ticket/answered" class="fw-light pages" href="{{route('admin.support.ticket.answered')}}">
                        <i class="far fa-dot-circle me-3"></i>{{decode('Answered Ticket')}}</a>
                    </li>
                    <li >
                        <a data-target="admin/support/ticket/replied" class="fw-light pages" href="{{route('admin.support.ticket.replied')}}">
                        <i class="far fa-dot-circle me-3"></i>{{decode('Replied Ticket')}}</a>
                    </li>
                    <li >
                        <a data-target="admin/support/ticket/closeds" class="fw-light pages" href="{{route('admin.support.ticket.closeds')}}">
                        <i class="far fa-dot-circle me-3"></i>{{decode('Closed Ticket')}}</a>
                    </li>                             
                </ul>
            </li>
        </ul>
        @endif   
        <!-- support ticket end-->


        <!-- setting start  -->
        @if ($authUser->can('configSettings.index') || $authUser->can('generalSettings.index') || $authUser->can('currency.index'))
         <span class="mb-1">{{ decode('System Setup') }}</span>
           @if($authUser->can('currency.index'))
                <ul>
                    <li class="d--flex align--center">
                        <a data-target="admin/currency/index" class="ms--1 d--flex align--center pages" href="{{ route('admin.currency.index') }}">
                            <div>
                                <span class="me-3"><i class="fs-5 las la-wallet"></i></span><span>{{ decode('Currency Setup') }}</span>
                            </div>
                            <p></p>
                        </a>
                    </li>
                </ul>
            @endif

            @if($authUser->can('generalSettings.index'))
                <ul>
                    <li class="d--flex align--center">
                        <a data-target="admin/settings/index" class="ms--1 d--flex align--center pages" href="{{ route('admin.settings.index') }}">
                            <div>
                                <span class="me-3"><i class="fs-5 lab la-react"></i></span><span>{{ decode('Business Logic') }}</span>
                            </div>
                            <p></p>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="d--flex align--center">
                        <a data-target="admin/mail/template/index" class="ms--1 d--flex align--center pages" href="{{ route('admin.mail.template.index') }}">
                            <div>
                                <span class="me-3"><i class="fs-5 las la-paper-plane"></i></span><span>{{ decode('Mail Template') }}</span>
                            </div>
                            <p></p>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a class="ms--1 d--flex align--center side_bar_list" href="javascript:void(0)">
                        <div>
                            <span class="me-3"><i class="las fs-5 la-camera"></i></span><span>{{decode('Media')}}</span>
                        </div>
                        <i class="las la-angle-down"></i>
                        </a>
                        <ul>
                            <li>
                                <a data-target="admin/settings/social-media" class="fw-light pages" href="{{route('admin.settings.socialMedia.link')}}"><i class="far fa-dot-circle me-3"></i>{{decode('Social Media Link')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class="d--flex align--center ">
                    <a data-target="/admin/settings/mail-config" class="ms--1 d--flex align--center pages" href="{{route('admin.settings.mail')}}">
                        <div>
                            <span class="me-3"><i class="las fs-5 la-table"></i></span><span>3rd Party</span>
                        </div>
                        <p></p>
                    </a>
                    </li>
                </ul>
            @endif
        @endif


        <ul>
            <li class="d--flex align--center">
                <a class="ms--1 d--flex align--center" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();" href="javascript:void(0)">
                <div>
                    <span class="me-3"><i class="fs-5 las la-sign-out-alt me-2"></i></span><span>Logout</span>
                </div>
                </a>
                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- setting end  -->
      </div>
    </div>
    <div class="version-container">
      <span>version</span><span class="ms-1">1.1</span>
      <span class="d-block text-secondary">{{ $generalSetting->copy_right_text }}</span>
    </div>
  </div>
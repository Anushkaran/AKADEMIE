<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{route('partner.dashboard')}}">
                        <img  height="30%" width="30%" src="{{asset('assets/vuexy/app-assets/images/logo/logo.png')}}"/>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">

        <ul class="nav navbar-nav align-items-center ml-auto">

            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">
                            {{auth()->user()->name}}
                        </span>
                        <span class="user-status">
                            {{trans_choice('labels.partner',1)}}
                        </span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{asset('assets/vuexy/app-assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="#">
                        <i class="mr-50" data-feather="user"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="mr-50" data-feather="mail"></i>
                        Inbox
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#">
                        <i class="mr-50" data-feather="settings"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="mr-50" data-feather="help-circle"></i>
                        FAQ
                    </a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('logout-form').submit()">
                        <i class="mr-50" data-feather="power"></i>
                        Logout
                    </a>

                    <form action="{{route('partner.logout')}}" method="post" id="logout-form">@csrf</form>
                </div>
            </li>
        </ul>
    </div>
</nav>


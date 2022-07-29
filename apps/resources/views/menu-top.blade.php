<ul>
    @if(logined())
        <li data-active="dashboard">
            <a href="{{ url(\App\Providers\RouteServiceProvider::HOME) }}">
                <img src="{{ asset('assets/img/dashboard.png') }}" alt="">
                DASHBOARD
            </a>
        </li>
        <li data-active="list-member">
            <a href="{{ route('list-member') }}">
                <img src="{{ asset('assets/img/people.png') }}" alt="">
                LIST MEMBER
            </a>
        </li>
        @if(user()->is_user)
            <li>
                <a href="">
                    <img src="{{ asset('assets/img/report.png') }}" alt="">
                    REPORT
                    <div class="nav-down">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="{{ asset('assets/img/profile.png') }}" alt="">
                    PROFILE
                    <div class="nav-down">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                </a>
            </li>
        @else
            <li data-active="wallet-member">
                <a href="{{ route('wallet-member') }}">
                    <img src="{{ asset('assets/img/wallet.png') }}" alt="">
                    WALLET MEMBER
                </a>
            </li>
            <li data-active="report">
                <a href="{{ route('report') }}">
                    <img src="{{ asset('assets/img/report.png') }}" alt="">
                    REPORT
                </a>
            </li>
            <li data-active="settings" class="has-sub-menu">
                <a href="" onclick="event.preventDefault()">
                    <img src="{{ asset('assets/img/settings.png') }}" alt="">
                    SETTINGS
                    <div class="nav-down">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('setting.profile') }}">Profile</a></li>
                    <li><a href="{{ route('setting.change_password') }}">Change Password</a></li>
                    <li><a href="{{ route('setting.wallet') }}">Wallet</a></li>
                    <li><a href="{{ route('setting.banner') }}">Banner Manager</a></li>
                </ul>
            </li>
        @endif
        <li>
            <form action="{{ url('auth/logout') }}" method="POST" class="h-100" onclick="this.submit()">
                <img src="{{ asset('assets/img/logout.png') }}" alt="">
                LOGOUT
            </form>
        </li>
    @else
        <li>
            <a href="{{ route('auth.login') }}">
                <img src="{{ asset('assets/img/info.png') }}" alt="">
                Login
            </a>
        </li>
    @endif
</ul>

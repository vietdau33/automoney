<div class="container-fluid db-top">
    <div class="row">
        <div class="col-xl-4 col-12 p-1">
            <div class="db-top-box db-top-information">
                <div class="infor-avatar">
                    <div class="avatar-img">
                        <img src="{{ asset('assets/img/info.png') }}" alt="info">
                    </div>
                    <div class="avatar-footer p-2">
                        <h3>WELCOME</h3>
                        <h2 class="break-word text-center">{{ user()->username }}</h2>
                    </div>
                </div>

                <div class="infor-text w-100">
                    <h2>INFORMATION</h2>
                    <div class="info fullname mb-2">
                        <p class="mb-0">Full name:</p>
                        <b class="pl-2 break-word">{{ user()->info->fullname }}</b>
                    </div>
                    <div class="info email mb-2">
                        <p class="mb-0">Your Email:</p>
                        <b class="pl-2 break-word">{{ user()->email }}</b>
                    </div>
                    <div class="info phone mb-2">
                        <p class="mb-0">Your Phone:</p>
                        <b class="pl-2 break-word">{{ user()->info->phone }}</b>
                    </div>
                </div>
            </div>
        </div>
        @if(user()->is_user)
            <div class="col-xl-4 col-6 p-1">
                <div class="db-top-box db-top-deposit p-3">
                    <h2 class="deposit-title">DEPOSIT</h2>
                    <p class="deposit-text mb-0">Only send USDT-ERC20 to this address.</p>
                    <p class="deposit-text mb-0">Sending any other asset to this address may result in the loss of your deposit!</p>
                    <p class="deposit-text mb-0">You need to deposit 55 USDT-ERC20</p>
                    <p class="deposit-text text-info mb-0">USDT-ERC20 is the USDT of ETH</p>
                    @if(!empty(user()->wallet))
                        <div class="deposit-qr p-3" data-qr="{{ user()->wallet->address }}" data-qr-width="150" data-qr-height="150"></div>
                        <div class="code">
                            <p class="coppy-text break-word mb-0">{{ user()->wallet->address }}</p>
                            <div class="coppy-img copy-on-click" data-text="{{ user()->wallet->address }}">
                                <img src="{{ asset('assets/img/coppy.png') }}" alt="Copy">
                            </div>
                        </div>
                    @else
                        <h5 class="text-center text-primary mt-3">We'll create a wallet for you in a moment.</h5>
                    @endif
                </div>
            </div>
        @else
            <div class="col-xl-4 col-6 p-1">
                <div class="db-top-box db-top-deposit p-3 d-flex flex-column justify-content-around">
                    <div class="bonus">
                        <h2 class="deposit-title">TOTAL BONUS</h2>
                        <p class="deposit-title mb-0" style="font-size: 18px;">4,999 USDT</p>
                    </div>
                    <div class="member">
                        <h2 class="deposit-title">TOTAL MEMBER</h2>
                        <p class="deposit-title mb-0" style="font-size: 18px;">999</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-4 col-6 p-1">
            <div class="db-top-box db-top-invite_link p-3">
                @php($invite_link = route('auth.reflink', ['reflink' => user()->reflink]))
                <h2 class="invite-title">INVITE LINK</h2>
                @if(user()->is_active || user()->is_admin)
                    <div class="invite-qr p-3" data-qr="{{ $invite_link }}" data-qr-width="150" data-qr-height="150"></div>
                    <div class="code">
                        <p class="coppy-text break-word mb-0">{{ $invite_link }}</p>
                        <div class="coppy-img copy-on-click" data-text="{{ $invite_link }}">
                            <img src="{{ asset('assets/img/coppy.png') }}" alt="Copy">
                        </div>
                    </div>
                @else
                    <h5 class="text-center text-primary">You need to deposit 55 USDT to get the referral link!</h5>
                @endif
            </div>
        </div>
    </div>
</div>

@extends('layout')
@section('css')
    <style>
        .table-wallet-member .title-level {
            position: relative;
        }
        .table-wallet-member .title-level:after {
            content: "";
            width: 100%;
            height: 0;
            position: absolute;
            bottom: 0;
            left: 0;
            border: 1px solid #fff;
            transform: translateY(100%);
        }
    </style>
@endsection
@section('contents')
    <div class="wallet-member">
        <h5 class="text-uppercase heading-page mb-3">
            <img src="{{ asset('assets/img/wallet.png') }}" alt="">
            Wallet member
        </h5>
        <div class="form-search mb-3">
            @include('form-search')
        </div>
        <div class="table-wallet-member">
            <div class="table-radius">
                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Wallet</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php($stt = 1)
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $stt++ }}</th>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->info->address_wallet }}</td>
                                <td>
                                    <button
                                        class="btn btn-info"
                                        onclick="openModelEditWallet('{{ $user->id }}', '{{ $user->username }}', '{{ $user->info->address_wallet }}')"
                                    >
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <div class="modal fade" id="modalEditWallet" tabindex="-1" role="dialog" aria-labelledby="modalEditWalletLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header color-white" style="background-color: #16a3fe">
                    <h5 class="modal-title text-uppercase" id="modalEditWalletLabel">Edit wallet: <span style="font-size: 1.25rem" data-item="username"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('wallet-member.edit') }}" method="POST" onsubmit="return EditAddressWallet(this)">
                        <input type="hidden" name="userid">
                        <div class="form-group">
                            <input type="text" class="form-control" name="address_wallet">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-update-wallet w-75">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modal = document.querySelector('#modalEditWallet');
        window.openModelEditWallet = function(userid, username, user_address_wallet) {
            $(modal).find('[data-item="username"]').text(username);
            $(modal).find('[name="userid"]').val(userid);
            $(modal).find('[name="address_wallet"]').val(user_address_wallet);
            $(modal).modal();
        }
        window.EditAddressWallet = function(form) {
            const url = form.getAttribute('action');
            const formData = new FormData(form);
            $(form).find('.btn-update-wallet').prop('disabled', true);
            Request.ajax(url, formData, function(result) {
                if(result.success === 1) {
                    $(modal).modal('hide');
                    return alertify.alertSuccess(result.message, function() {
                        location.reload();
                    });
                }
                $(modal).fadeOut(100);
                $('.modal-backdrop').fadeOut(100);
                alertify.alertDanger(result.message, function() {
                    $(modal).fadeIn(100);
                    $('.modal-backdrop').fadeIn(100);
                    $(form).find('.btn-update-wallet').prop('disabled', false);
                });
            });
            return false;
        }
    </script>
@endsection

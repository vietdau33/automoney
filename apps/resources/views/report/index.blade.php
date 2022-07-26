@extends('layout')
@section('css')
    <style>
        .table-report .title-level {
            position: relative;
        }
        .table-report .title-level:after {
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
    <div class="reports">
        <h5 class="text-uppercase heading-page mb-3">
            <img src="{{ asset('assets/img/report.png') }}" alt="">
            Report Bonus
        </h5>
        <div class="form-search mb-3">
            <form action="" method="POST" class="d-flex flex-wrap">
                @csrf
                <div class="form-group mb-0 p-1">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group mb-0 p-1">
                    <input type="text" class="form-control bs-datepicker" name="date_from" placeholder="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group mb-0 p-1">
                    <input type="text" class="form-control bs-datepicker" name="date_to" placeholder="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group mb-0 p-1">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="table-report">
            <div class="table-radius">
                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Date</th>
                        <th scope="col">From User</th>
                        <th scope="col">Level</th>
                        <th scope="col">USDT</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <div class="modal fade" id="modalEditWallet" tabindex="-1" role="dialog" aria-labelledby="modalEditWalletLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header color-white" style="background-color: #16a3fe">
                    <h5 class="modal-title text-uppercase" id="modalEditWalletLabel">Edit wallet: <span data-item="username"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" value="aaaa">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary w-75">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

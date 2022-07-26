@extends('layout')
@section('css')
    <style>
        .table-list-member .title-level {
            position: relative;
        }
        .table-list-member .title-level:after {
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
    <div class="list-member">
        <h5 class="text-uppercase heading-page mb-3">
            <img src="{{ asset('assets/img/people.png') }}" alt="">
            List member
        </h5>
        <div class="form-search mb-3">
            <form action="" method="POST" class="d-flex flex-wrap">
                @csrf
                <div class="form-group mb-0 p-1">
                    <select name="level" class="form-control">
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                        <option value="5">Level 5</option>
                        <option value="6">Level 6</option>
                        <option value="7">Level 7</option>
                    </select>
                </div>
                <div class="form-group mb-0 p-1">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group mb-0 p-1">
                    <input type="text" class="form-control bs-datepicker" name="date-from" placeholder="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group mb-0 p-1">
                    <input type="text" class="form-control bs-datepicker" name="date-to" placeholder="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group mb-0 p-1">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="table-list-member">
            <div class="title-level mb-3">
                <h5 class="color-white mb-0">Level 1</h5>
            </div>
            <div class="table-radius">
                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Sponsor</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

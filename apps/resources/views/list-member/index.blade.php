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
            @include('form-search', ['is_list_member' => true])
        </div>
        <div class="table-list-member">
            <div class="title-level mb-3">
                <h5 class="color-white mb-0">Level 1</h5>
            </div>
            <div class="table-radius">
                <table class="table table-striped text-center" id="table_list_member">
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
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const tableListMember = document.querySelector('#table_list_member');
        const selectLevel = document.querySelector('[name="level"]');
        $(() => {
            const listUsers = {!! json_encode($listUsers) !!};
            Object.keys(listUsers).map(level => {
                const option = $('<option />').val(level).text('Level ' + level);
                $(selectLevel).append(option);
            });
            window.updateTableMember = () => {
                let index = 1;
                const level = $(selectLevel).val();
                const $tbody = $(tableListMember).find('tbody');

                $tbody.empty();

                if (typeof listUsers[level] == 'undefined') {
                    $tbody.append('<tr><td colspan="7">No user</td></tr>');
                    return;
                }

                listUsers[level].map(user => {
                    const $tr = $('<tr />');
                    let status;
                    if (user.is_active === 1) {
                        status = '<span class="text-primary">Active</span>';
                    } else {
                        status = '<span class="text-danger">Not activated</span>';
                    }
                    $tr.append('<th scope="row">' + index++ + '</th>');
                    $tr.append('<td>' + user.username + '</td>');
                    $tr.append('<td>' + user.info.phone + '</td>');
                    $tr.append('<td>' + user.email + '</td>');
                    $tr.append('<td>' + (user.sponsor == null ? 'ROOT' : user.sponsor.username) + '</td>');
                    $tr.append('<td>' + formatDate(user.created_at) + '</td>');
                    $tr.append('<td>' + status + '</td>');
                    $tbody.append($tr);
                });
            }
            $(selectLevel).on('change', updateTableMember);
            $(selectLevel).trigger('change');
            console.log(listUsers)
        });
    </script>
@endsection

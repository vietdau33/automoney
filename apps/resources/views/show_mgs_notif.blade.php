<script>
    //show notif
    @if(session()->has('mgs_success'))
        alertify.alertSuccess('Success', '{{session()->pull('mgs_success')}}');
    @endif

    //show error
    @if(session()->has('mgs_error'))
        alertify.alertDanger('Error', '{{session()->pull('mgs_error')}}');
    @endif
</script>

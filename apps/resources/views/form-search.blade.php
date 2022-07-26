<form action="" method="GET" class="d-flex flex-wrap">
    <div class="form-group mb-0 p-1">
        <select name="level" class="form-control"></select>
    </div>
    <div class="form-group mb-0 p-1">
        <input type="text" class="form-control" name="username" value="{{ request()->username }}" placeholder="Username">
    </div>
    <div class="form-group mb-0 p-1">
        <input type="text" class="form-control bs-datepicker" value="{{ request()->date_from }}" name="date_from" placeholder="Date From">
    </div>
    <div class="form-group mb-0 p-1">
        <input type="text" class="form-control bs-datepicker" value="{{ request()->date_to }}" name="date_to" placeholder="Date To">
    </div>
    <div class="form-group mb-0 p-1">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

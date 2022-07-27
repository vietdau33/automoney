<form action="" method="GET" class="d-flex flex-wrap">
    @if($is_list_member ?? false)
        <div class="form-group mb-0 p-1">
            <select name="level" class="form-control"></select>
        </div>
    @endif
    <div class="form-group mb-0 p-1">
        <input
            type="text"
            class="form-control"
            name="username"
            value="{{ request()->username }}"
            placeholder="Username"
        />
    </div>
    <div class="form-group mb-0 p-1">
        <input
            type="text"
            class="form-control bs-datepicker"
            value="{{ request()->date_from }}"
            name="date_from"
            placeholder="Date From"
            autocomplete="off"
        />
    </div>
    <div class="form-group mb-0 p-1">
        <input
            type="text"
            class="form-control bs-datepicker"
            value="{{ request()->date_to }}"
            name="date_to"
            placeholder="Date To"
            autocomplete="off"
        />
    </div>
    <div class="form-group mb-0 p-1">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

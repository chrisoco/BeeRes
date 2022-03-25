
<div class="card col-lg-8 offset-lg-2 mb-2 mb-md-0">
    <div class="card-header text-center"><h4>Imker Search</h4></div>
    <div class="card-body" style="height: 21.5rem">
        <div class="input-group mb-1">
            <input type="text" class="form-control" id="searchInput" onkeyup="searchPlz(this)" placeholder="PLZ Search" autocomplete="off" aria-describedby="basic-addon">
            <div class="input-group-append">
                <span class="input-group-text h-100" id="basic-addon">
                    <i class="fa-solid fa-3 fa-magnifying-glass"></i>
                </span>
            </div>
        </div>
        <div class="list-group overflow-auto border" style="max-height: 7.6rem" id="plzSearchOutput"></div>
        <div class="list-group overflow-auto border mt-1" style="max-height: 16.7rem" id="beekeeperSearchOutput"></div>
    </div>
</div>
<script>
    const searchPlzUrl       = '{{ route('guest.search.plz') }}';
    const searchBeekeeperUrl = '{{ route('guest.search.beekeeper') }}';
</script>
<script src="{{ asset('js/imkerSearch.js') }}"></script>

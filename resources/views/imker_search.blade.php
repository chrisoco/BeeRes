<div class="card col-lg-8 offset-lg-2 mb-2 mb-md-0">
    <div class="card-header text-center"><h4>Imker Search</h4></div>

    <div class="card-body" style="height: 21.5rem">

        <div class="input-group mb-1">
            <input type="text" class="form-control" id="searchInput" onkeyup="searchPlz(this)" placeholder="PLZ Search" autocomplete="off" aria-describedby="basic-addon">
            <div class="input-group-append">
                <span class="input-group-text h-100" id="basic-addon"><i class="fa-solid fa-3 fa-magnifying-glass"></i></span>
            </div>
        </div>

        <div class="list-group overflow-auto border" style="max-height: 7.6rem" id="plzSearchOutput"></div>
        <div class="list-group overflow-auto border mt-1" style="max-height: 16.7rem" id="beekeeperSearchOutput"></div>

    </div>
</div>
<script>

    const plzSearch       = document.getElementById('plzSearchOutput');
    const beekeeperSearch = document.getElementById('beekeeperSearchOutput');

    function searchPlz (e) {

        $.ajax({
            type   : "get",
            url    : '{{ route('guest.search.plz') }}',
            data   : {search: e.value},
            success: function (data) {

                $('.oldSearch').remove();

                for(let postcode of data) {
                    insertPLZ(postcode);
                }

            }
        });

    }

    function insertPLZ(postcode) {

        let el = document.createElement('div');
        el.setAttribute('class', 'list-group-item list-group-item-action oldSearch');
        el.innerHTML = postcode.postcode + ' | ' + postcode.name;
        el.setAttribute('onclick', 'selectPostcode(this,'+ postcode.id +')');

        plzSearch.appendChild(el);

    }

    function selectPostcode(e, postcode_id) {

        document.getElementById('searchInput').value = e.innerHTML;
        $('.oldSearch').remove();

        searchBeekeeper(postcode_id);

    }

    function searchBeekeeper(postcode_id) {

        $.ajax({
            type   : "get",
            url    : '{{ route('guest.search.beekeeper') }}',
            data   : {postcode_id: postcode_id},
            success: function (data) {

                $('.oldSearch').remove();

                for(let beekeeper of data) {
                    insertBeekeeper(beekeeper);
                }

            }
        });

    }

    function insertBeekeeper(beekeeper) {

        console.log(beekeeper);

        let jurEl = document.createElement('p');
        jurEl.setAttribute('class', 'small');
        jurEl.innerHTML = beekeeper.jurisdictionsToString;


        let el = document.createElement('div');
        el.setAttribute('class', 'list-group-item list-group-item-action oldSearch');
        el.innerHTML = beekeeper.fullName + '<br>' + beekeeper.formattedPhone;
        el.append(jurEl);

        beekeeperSearch.appendChild(el);

    }

</script>

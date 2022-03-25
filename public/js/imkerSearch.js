/*
|--------------------------------------------------------------------------
| Imker Search JS
|--------------------------------------------------------------------------
|
| Handles all JS for the beekeeper and plz search.
|
*/

// Define output elements
const plzSearch       = document.getElementById('plzSearchOutput');
const beekeeperSearch = document.getElementById('beekeeperSearchOutput');

/**
 * Request Search of PLZ
 *
 * @param e
 */
function searchPlz (e) {

    $.ajax({
        type   : "get",
        url    : searchPlzUrl,
        data   : {search: e.value},
        success: function (data) {

            $('.oldSearch').remove();

            for(let postcode of data) {
                insertPLZ(postcode);
            }

        }
    });

}

/**
 * Append Postcode information in search result.
 *
 * @param postcode
 */
function insertPLZ(postcode) {

    let el = document.createElement('div');
    el.setAttribute('class', 'list-group-item list-group-item-action oldSearch');
    el.innerHTML = postcode.postcode + ' | ' + postcode.name;
    el.setAttribute('onclick', 'selectPostcode(this,'+ postcode.id +')');

    plzSearch.appendChild(el);

}

/**
 * Select PLZ from PLZ search result & search for beekeeper
 *
 * @param e
 * @param postcode_id
 */
function selectPostcode(e, postcode_id) {

    document.getElementById('searchInput').value = e.innerHTML;
    $('.oldSearch').remove();

    searchBeekeeper(postcode_id);

}

/**
 * Request Search of Beekeeper
 *
 * @param postcode_id
 */
function searchBeekeeper(postcode_id) {

    $.ajax({
        type   : "get",
        url    : searchBeekeeperUrl,
        data   : {postcode_id: postcode_id},
        success: function (data) {

            $('.oldSearch').remove();

            for(let beekeeper of data) {
                insertBeekeeper(beekeeper);
            }

        }
    });

}

/**
 * Append Beekeeper information in search result.
 *
 * @param beekeeper
 */
function insertBeekeeper(beekeeper) {

    let jurEl = document.createElement('p');
    jurEl.setAttribute('class', 'small');
    jurEl.innerHTML = beekeeper.jurisdictionsToString;


    let el = document.createElement('div');
    el.setAttribute('class', 'list-group-item list-group-item-action oldSearch');
    el.innerHTML = beekeeper.fullName + '<br>' + beekeeper.reverseFormattedPhone;
    el.append(jurEl);

    beekeeperSearch.appendChild(el);

}

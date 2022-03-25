/*
|--------------------------------------------------------------------------
| Jurisdiction JS
|--------------------------------------------------------------------------
|
| Handles all JS for the beekeeper jurisdiction and plz search.
|
*/

// Define output element
const searchRes = document.getElementById('searchOutput');

/**
 * Add selected PLZ to Delete
 *
 * @param id
 * @param el
 */
function del(id, el) {

    const delJur = document.getElementById('delJur');

    let duplicate = false;

    // Eval is PLZ should be delete or revert de deletion
    document.getElementsByName('delJur[]').forEach(element => {
        if(element.value == id) {
            duplicate = true;
            element.remove();
        }
    });

    // revert if duplicate found else add to delete
    if(duplicate) {
        el.style.border = '1px solid rgba(0, 0, 0, 0.125)';

    } else {
        el.style.border = '1px solid red';

        let input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'delJur[]');
        input.setAttribute('value', id);

        delJur.append(input);
    }

}

/**
 * Add PLZ from Search result to form.
 *
 * @param el
 * @param id
 */
function add(el, id) {

    el.removeAttribute('onclick');
    el.classList.remove('oldSearch');
    el.style.border = '1px solid green';
    el.innerHTML    = el.innerHTML + '<button type="button" class="btn btn-danger float-end" onclick="reverseAdd('+id+', this.parentElement)">X</button>';

    document.getElementById('currentJur').append(el);


    let input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'addJur[]');
    input.setAttribute('value', id);

    document.getElementById('addJur').append(input);

}

/**
 * Reverse a frontend Only added PLZ from form
 *
 * @param id
 * @param el
 */
function reverseAdd(id, el) {
    document.getElementsByName('addJur[]').forEach(element => {
        if(element.value == id) {
            element.remove();
        }
    });
    el.remove();
}

/**
 * Request Search of PLZ
 *
 * @param e
 */
function search (e) {

    $.ajax({
        type   : "get",
        url    : searchURL,
        data   : {search: e.value},
        success: function (data) {

            $('.oldSearch').remove();

            for(let postcode of data) {
                insert(postcode);
            }

        }
    });

}

/**
 * Append Postcode information in search result.
 *
 * @param postcode
 */
function insert(postcode) {

    let el = document.createElement('div');
    el.setAttribute('class', 'list-group-item list-group-item-action oldSearch');
    el.setAttribute('onclick', 'add(this,'+ postcode.id +')');
    el.innerHTML = postcode.postcode + ' | ' + postcode.name;

    searchRes.appendChild(el);

}


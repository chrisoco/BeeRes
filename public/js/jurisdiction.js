/*
 *
 *
 *
 */

/**
 *
 * @param id
 * @param el
 */
function del(id, el) {

    const delJur = document.getElementById('delJur');

    let duplicate = false;

    document.getElementsByName('delJur[]').forEach(element => {
        if(element.value == id) {
            duplicate = true;
            element.remove();
        }
    });

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

function reverseAdd(id, el) {
    document.getElementsByName('addJur[]').forEach(element => {
        if(element.value == id) {
            element.remove();
        }
    });
    el.remove();
}

const searchRes = document.getElementById('searchOutput');

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

function insert(postcode) {

    let el = document.createElement('div');
    el.setAttribute('class', 'list-group-item list-group-item-action oldSearch');
    el.setAttribute('onclick', 'add(this,'+ postcode.id +')');
    el.innerHTML = postcode.postcode + ' | ' + postcode.name;

    searchRes.appendChild(el);

}


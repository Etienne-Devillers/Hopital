
var checkboxAjax = document.querySelector('#checkboxAjax');

function affichage(){
    console.log(query.value);
}
function fetchFunction(){

    query = document.querySelector('.searchField').value;

    fetch(`/controllers/ajax-controller.php?search=${query}`)
    .then(function(response) {
        return response.json();
    })

    .then(function(datas) { 
console.log(datas);
tbody.innerHTML = '';

datas.forEach(element => {
    const date= new Date(element.birthdate);
    tbody.innerHTML += `<tr>
        <th scope="row"> ${element.id} </th>
        <td> ${element.lastname} </td>
        <td> ${element.firstname} </td>
        <td> ${date.toLocaleDateString("fr")} </td>
        <td> <a href="tel:${element.phone}">${element.phone} </a></td>
        <td> <a href="mailto:${element.mail}">${element.mail}</a> </td>
        <td>
            <a href="/controllers/patients/profil-patient-controller.php?id=${element.id}"><img src="/public/assets/img/eye-solid.svg" alt="" class="eye"></a> 
            <a type="btn" href="" class="modalToggler" 
            data-bs-id="${element.id}"
            data-bs-toggle="modal" 
            data-bs-firstname="${element.lastname}"
            data-bs-lastname="${element.firstname}"
            data-bs-target="#confirmDeleteModal"><img src="/public/assets/img/trash-can-solid.svg" alt="" class="eye"></a>
        </td>
    </tr>`
});


    })


}




checkboxAjax.addEventListener('click', () => {
    if (checkboxAjax.checked === true) {

        searchButton.style.visibility = 'hidden';
        document.querySelector('.searchField').addEventListener('input', fetchFunction);
        
    } else {
        searchButton.style.visibility = '';
        document.querySelector('.searchField').removeEventListener('input', fetchFunction);

    }
});


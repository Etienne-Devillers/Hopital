// Création des evenements d'affichage des modals pour la suppression des patients et/ou RDV
    var btns = document.querySelectorAll('.modalToggler');
    var btnsAppointments = document.querySelectorAll('.modalTogglerAppointments');

    if (btns.length !== 0) {

        btns.forEach(element => {
            element.addEventListener('click', () => {
                confirmButtonDelete.href='/controllers/patients/delete-patient-controller.php?id='+element.dataset.bsId;
                modalFirstname.innerHTML=element.dataset.bsFirstname;
                modalLastname.innerHTML=element.dataset.bsLastname;
            })
        });
    }


        btnsAppointments. forEach(element => {
            element.addEventListener('click', () => {
                confirmButtonDelete.href='/controllers/appointments/delete-appointment-controller.php?id='+element.dataset.bsId;
            })
        });


//Recherche dynamique d'un client



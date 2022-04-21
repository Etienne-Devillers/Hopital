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


// affichage des champs rendez vous en même temps que les champs pour ajouter un patient.

checkboxAppointment.addEventListener('click', () =>{

    if (checkboxAppointment.checked === true) {
console.log('hey');
        document.querySelector('.appointmentField').classList.add('d-flex');
        document.querySelector('.appointmentField').classList.remove('d-none');
        document.querySelector('.addPatientForm').action = '/controllers/patients/add-patient-appointment-controller.php';
        
    } else {
        
        document.querySelector('.appointmentField').classList.add('d-none');
        document.querySelector('.appointmentField').classList.remove('d-flex');
        document.querySelector('.addPatientForm').action = '/new-patient';

    }

})



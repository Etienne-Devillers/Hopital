<?php

include(dirname(__FILE__).'/views/templates/header.php');
?>


<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="wrapper mt-5">

                <div class="col1 bg-blue rounded-5 d-flex flex-column align-items-center justify-content-evenly">
                    <h4 class=" mt-3">Ajouter un patient</h4>
                    <a href="/new-patient"><button class="btn bg-green px-5 rounded-3">S'y rendre</button></a>
                </div>

                <div class="col2 bg-blue rounded-5 d-flex flex-column align-items-center justify-content-evenly">
                    <h4 class=" mt-3">Liste des patients</h4>
                    <a href="/patients"><button class="btn bg-green px-5 rounded-3">S'y rendre</button></a>
                </div>

                <div class="col3 bg-blue rounded-5 d-flex flex-column align-items-center justify-content-evenly">
                    <h4 class=" mt-3">Ajouter un RDV</h4>
                    <a href="/new-appointment"><button class="btn bg-green px-5 rounded-3">S'y rendre</button></a>
                </div>

                <div class="col4 bg-blue rounded-5 d-flex flex-column align-items-center justify-content-evenly">
                    <h4 class=" mt-3">liste des RDV</h4>
                    <a href="/list-appointments"><button class="btn bg-green px-5 rounded-3">S'y rendre</button></a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
include(dirname(__FILE__).'/views/templates/footer.php');
?>
<h1 class="text-center my-5">liste de tous les patients enregistrés dans la base de données.</h1>
<h3 class="text-center my-5"><?=$requestResult ?? '' ?></h3>
<section class="table container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="thead-dark bg-blue">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Date de naissance</th>
                        <th scope="col">N° tél</th>
                        <th scope="col">Adresse mail</th>
                        <th scope="col">Modif</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($patientList as $key => $value) {
                        ?>
                        <tr>
                            <th scope="row"> <?=$value->id?> </th>
                            <td> <?=$value->lastname?> </td>
                            <td> <?=$value->firstname?> </td>
                            <td> <?=$value->birthdate?> </td>
                            <td> <a href="tel:<?=$value->phone?>"><?=$value->phone?> </a></td>
                            <td> <a href="mailto:<?=$value->mail?>"><?=$value->mail?></a> </td>
                            <td>
                                <a href="/controllers/patients/profil-patient-controller.php?id=<?=$value->id?>"><img src="/public/assets/img/eye-solid.svg" alt="" class="eye"></a> 
                                <a type="btn" href="" class="modalToggler" 
                                data-bs-id="<?=$value->id?>"
                                data-bs-toggle="modal" 
                                data-bs-firstname="<?=$value->lastname?>"
                                data-bs-lastname="<?=$value->firstname?>"
                                data-bs-target="#confirmDeleteModal"><img src="/public/assets/img/trash-can-solid.svg" alt="" class="eye"></a>
                            </td>
                        </tr>
                    <?php
                    } 
                ?>
                </tbody>
            </table>
            <div>Vous voulez ajouter un nouveau patient ? <a href="/new-patient"><button class="btn bg-blue"> Cliquez ici</button></a>  </div>
        </div>
    </div>

</section>


<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteModalTitle">Confirmation suppression</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Souhaitez vous vraiment supprimer le patient ?(<span id="modalFirstname"> </span> <span id="modalLastname"> </span>)  <br>
            La supression entrainera une suppresion des RDV associés.
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <a href="" id="confirmButtonDelete"><button type="button" id="btnRed" class="btn  btn-danger">Confirmer</button></a>
            </div>
        </div>
    </div>
</div>
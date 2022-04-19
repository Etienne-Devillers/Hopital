<h1 class="text-center my-5">liste de tous les rendez vous dans la base de données.</h1>
<h3 class="text-center my-5"><?=$requestResult ?? '' ?></h3>
<section class="table container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="thead-dark bg-blue">
                    <tr>
                        <th scope="col">Date et heure</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">N° tél</th>
                        <th scope="col">Adresse mail</th>
                        <th scope="col">Modif</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($appointmentList as $key => $value) {
                        
                        $appointmentDate = DateTime::createFromFormat('Y-m-d H:i:s', $value->dateHour, new DateTimeZone('Europe/Paris'));

                        $diff = $appointmentDate->diff($currentDate);
                        
                        ?>
                        <tr class="<?= ($diff->invert == 0) ? 'bg-grey' :'' ?>">
                            <th scope="row"> <?=date("d-m-Y \à H:i", strtotime($value->dateHour))?> </th>
                            <td> <?=$value->lastname?> </td>
                            <td> <?=$value->firstname?> </td>
                            <td> <a href="tel:<?=$value->phone?>"><?=$value->phone?> </a></td>
                            <td> <a href="mailto:<?=$value->mail?>"><?=$value->mail?></a> </td>
                            <td> <a href="/detail-appointment?id=<?=$value->id?>"><img src="/public/assets/img/eye-solid.svg" alt="" class="eye eye<?=$value->id?>"></a>
                            <a type="btn" href="" class="modalTogglerAppointments" 
                                data-bs-id="<?=$value->id?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmDeleteModal"><img src="/public/assets/img/trash-can-solid.svg" alt="" class="eye"></a>
                            </td>
                        </tr>
                    <?php
                    } 
                ?>
                </tbody>
            </table>
            <div>Vous voulez ajouter un nouveau rendez vous ? <a href="/new-appointment"><button class="btn bg-blue"> Cliquez ici</a></button>  </div>
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
            Souhaitez vous vraiment supprimer le RDV ?<br>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <a href="" id="confirmButtonDelete"><button type="button" id="btnRed" class="btn btn-danger">Confirmer</button></a>
            </div>
        </div>
    </div>
</div>
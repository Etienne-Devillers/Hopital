<h1 class="text-center my-5">liste de tous les rendez vous dans la base de données.</h1>

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
                        // var_dump($diff);
                        ?>
                        <tr class="<?= ($diff->invert == 0) ? 'bg-grey' :'' ?>">
                            <th scope="row"> <?=date("d-m-Y \à H:i", strtotime($value->dateHour))?> </th>
                            <td> <?=$value->lastname?> </td>
                            <td> <?=$value->firstname?> </td>
                            <td> <a href="tel:<?=$value->phone?>"><?=$value->phone?> </a></td>
                            <td> <a href="mailto:<?=$value->mail?>"><?=$value->mail?></a> </td>
                            <td> <a href="/controllers/patients/profil-patient-controller.php?id=<?=$value->id?>"><img src="/public/assets/img/eye-solid.svg" alt="" class="eye"></a> </td>
                        </tr>
                    <?php
                    } 
                ?>
                </tbody>
            </table>
            <div>Vous voulez ajouter un nouveau rendez vous ? <a href="/new-patient.php"><button class="btn bg-blue"> Cliquez ici</a></button>  </div>
        </div>
    </div>

</section>
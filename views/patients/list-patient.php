<h1 class="text-center my-5">liste de tous les patients enregistrés dans la base de donnée.</h1>

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
                            <td> <a href="/controllers/profil-patient-controller.php?id=<?=$value->id?>"><img src="/public/assets/img/eye-solid.svg" alt="" class="eye"></a> </td>
                        </tr>
                    <?php
                    } 
                ?>
                </tbody>
            </table>
            <div>Vous voulez ajouter un nouveau patient ? <a href="/controllers/add-patient-controller.php"><button class="btn bg-blue"> Cliquez ici</a></button>  </div>
        </div>
    </div>

</section>
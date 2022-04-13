<section class="userProfile">
<form action="/controllers/add-patient-controller.php" method="POST">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
                    <div class="row">
                        <div class="col d-flex flex-column align-items-center">
                            <input type="hidden" name="id" value="<?=$requestResult[0]->id?>">
                            <div><img src="/public/assets/img/user.png" alt="" class="userImg"></div>
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="lastname"
                            class="form-control nameUserForm"
                            name ="lastname"
                            id="lastname"
                            aria-describedby="emailHelp"
                            pattern="<?= REGEX_NO_NUMBER ?>"
                            value="<?=$requestResult[0]->lastname?>"
                            required>

                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="firstname"
                            class="form-control nameUserForm"
                            name ="firstname"
                            id="firstname"
                            aria-describedby="emailHelp"
                            pattern="<?= REGEX_NO_NUMBER ?>"
                            value="<?=$requestResult[0]->firstname?>"
                            required>
                        </div>
                    </div>
                </div>

                <div class="headerProfile container mt-4 p-3 bg-blue rounded-5">
                    <div class="row">
                        <div class="col d-flex flex-column align-items-center ">

                                <div class="d-flex flex-column phone userFormChange">
                                    <label for="phonenumber"
                                    class="form-label">Numéro de téléphone</label>
                                    <input type="tel"
                                    class="form-control nameUserForm"
                                    name ="phonenumber"
                                    id="phonenumber"
                                    value="<?=$requestResult[0]->phone?>"
                                    >
                                </div>
                            
                                <div class="d-flex flex-column birth userFormChange mt-3">
                                    <label for="birthdate" class="form-label">Date de naissance</label>
                                    <input type="date"
                                    class="form-control nameUserForm"
                                    name ="birthdate"
                                    id="birthdate"
                                    value="<?=date("Y-m-d",strtotime($requestResult[0]->birthdate))?>"
                                    required>
                                </div>

                                <div class="d-flex flex-column email userFormChange mt-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email"
                            class="form-control nameUserForm"
                            id="email"
                            name ="email"
                            aria-describedby="emailHelp"
                            value="<?=$requestResult[0]->mail?>"
                            required>
                                </div>
                        </div>
                    </div>
                </div>
                    <button type="submit "class="btn bg-green my-4">
                        <img src="/public/assets/img/check-solid.svg" alt="" class="svgUser mx-1">
                        Valider
                    </button>
                </a>
            </div>
        </div>
    </div>
</form>
</section>
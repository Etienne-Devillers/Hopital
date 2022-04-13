<section class="userProfile">
<form action="">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
                    <div class="row">
                        <div class="col d-flex flex-column align-items-center">
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
                            <div class="d-flex">
                            <img src="/public/assets/img/phone-solid.svg" alt="" class="svgUser mx-5">
                                <div class="display-5"><?=$requestResult[0]->phone?></div>
                            </div>
                            <div  class="d-flex mt-4">
                                <img src="/public/assets/img/envelope-solid.svg" alt="" class="svgUser mx-5">
                                <div class="display-5"><?=$requestResult[0]->mail?></div>
                            </div>
                            <div  class="d-flex mt-4">
                                <img src="/public/assets/img/cake-candles-solid.svg" alt="" class="svgUser mx-5">
                                <div class="display-5"><?=$requestResult[0]->birthdate?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/controllers/profil-patient-controller.php?id=<?=$requestResult[0]->id?>&modify=1">
                    <button class="btn bg-blue mt-4">
                        <img src="/public/assets/img/pencil-solid.svg" alt="" class="svgUser mx-1">
                        Modifier
                    </button>
                </a>
            </div>
        </div>
    </div>
</form>
</section>
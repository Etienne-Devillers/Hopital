

<h1 class="text-center mt-5">Ajouter un rendez vous</h1>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="/controllers/appointments/add-appointment-controller.php" methos="post">
                <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
                    <div class="row">
                        <div class="col d-flex flex-column align-items-center">
                            <input type="hidden" name="id" value="<?=$requestResult[0]->id?>">
                            <label for="email" class="form-label">Email du patient</label>
                            <select name="email" id="email" class="form-control nameUserForm">
                                <option value="">Choisissez un patient</option>
                                <?php
                                foreach ($mailList as $key => $value) {
                                ?>
                                <option value="<?=$value->mail?>"><?=$value->mail?></option>
                                <?php }
                                ?>
                            </select>

                            <label for="dateHour" class="form-label">Date et heure</label>
                            <input type="datetime-local" class="form-control nameUserForm" name="dateHour" id="dateHour"
                                aria-describedby="emailHelp"  value="" required>
                        </div>
                    </div>
                </div>
                <button type="submit " class="btn bg-green my-4">
                    <img src="/public/assets/img/check-solid.svg" alt="" class="svgUser mx-1">
                    Valider
                </button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="text-center mt-3">Ajouter un patient</h1>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="POST" class="addPatientForm" action="/new-patient">
                <div class="container ">
                    <div class="row ">

                        <div class="mb-3 offset-sm-2 offset-0 col-12 col-sm-4">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="lastname"
                            class="form-control <?= isset($error['lastname']) ? 'errorField' : '' ?>"
                            name ="lastname"
                            id="lastname"
                            aria-describedby="emailHelp"
                            pattern="<?= REGEX_NO_NUMBER ?>"
                            value="<?= htmlentities($lastname ?? '') ?>"
                            required>
                            <small id="lastnameHelp" class="form-text error"><?= $error['lastname'] ?? '' ?></small>
                        </div>

                        <div class="offset-0 col-12 mb-3 col-sm-4">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="firstname"
                            class="form-control <?= isset($error['firstname']) ? 'errorField' : '' ?>"
                            name ="firstname"
                            id="firstname"
                            aria-describedby="emailHelp"
                            pattern="<?= REGEX_NO_NUMBER ?>"
                            value="<?= htmlentities($firstname ?? '') ?>"
                            required>
                            <small id="firstnameHelp" class="form-text error"><?= $error['firstname'] ?? '' ?></small>
                        </div>

                        <div class="offset-0 col-12 mb-3 offset-sm-2 col-sm-4">
                            <label for="birthdate" class="form-label">Date de naissance</label>
                            <input type="date"
                            class="form-control <?= isset($error['birthdate']) ? 'errorField' : '' ?>"
                            name ="birthdate"
                            id="birthdate"
                            value="<?= htmlentities($birthdate ?? '') ?>"
                            min="<?=date("Y-m-d", strtotime("-100 year"))?>"
                            max="<?=date('Y-m-d')?>"
                            required>
                            <small id="birthdateHelp" class="form-text error"><?= $error['birthdate'] ?? '' ?></small>
                        </div>

                        <div class="offset-0 col-12 mb-3 col-sm-4">
                            <label for="phonenumber"
                            class="form-label">Numéro de téléphone</label>
                            <input type="tel"
                            class="form-control <?= isset($error['phonenumber']) ? 'errorField' : '' ?>"
                            name ="phonenumber"
                            id="phonenumber"
                            value="<?= htmlentities($phonenumber ?? '') ?>"
                            >
                            <small id="phoneHelp" class="form-text error"><?= $error['phonenumber'] ?? '' ?></small>
                        </div>

                        <div class="offset-0 col-12 mb-4  offset-sm-2 col-sm-8">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email"
                            class="form-control <?= isset($error['email']) ? 'errorField' : '' ?>"
                            id="email"
                            name ="email"
                            aria-describedby="emailHelp"
                            value="<?= htmlentities($email ?? '') ?>"
                            required>
                            <small id="emailHelp" class="form-text error"><?= $error['email'] ?? '' ?></small>
                        </div>

                        </div>
                            <div class="appointmentField flex-row row  d-none">
                            
                                <div class="offset-sm-2 offset-0 col-12 col-sm-4 ">
                                <label for="date" class="form-label c-black">Date</label>
                                    <input type="date" class="form-control nameUserForm2" name="date" id="date"
                                        aria-describedby="emailHelp"  value=""  
                                        min="<?=date('Y-m-d')?>" max="<?=date("Y-m-d", strtotime("+2 year"))?>"
                                        required>
                                </div>
                                <div class=" offset-0 col-12 mb-3 col-sm-4">
                                    <label for="Hour" class="form-label c-black">Heure</label>
                                    <div class="d-flex flex-row align-items-center">
                                        <select name="hour" id="hour" class="form-control hourForm2">
                                            
                                            <?php
                                            for ($i=9; $i < 19; $i++) { 
                                            
                                            ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                            <?php }
                                            ?>
                                        </select>
                                                <span class="display-5 mx-1 separator2">:</span>
                                        <select name="minutes" id="minutes" class="form-control hourForm2">
                                            <?php
                                            for ($i=0; $i < 60; $i+=15) { 
                                            
                                            ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class=" offset-0 offset-sm-2">
                            <button type="submit" class="btn bg-blue ">Ajouter</button>
                        </div>
                        
                    <div class="form-check form-switch mt-4 offset-0 offset-sm-2">
                        <input class="form-check-input" type="checkbox" id="checkboxAppointment">
                        <label class="form-check-label" for="checkboxAppointment">Ajouter un rendez-vous</label>
                    </div>                  
                </div> 
            </form>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="text-center mt-3">Ajouter un client</h1>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="POST" action="/controllers/add-patient-controller.php">
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
                        </div>
                        <div class="offset-0 col-12 mb-3 offset-sm-2 col-sm-4">
                            <label for="birthdate" class="form-label">Date de naissance</label>
                            <input type="date"
                            class="form-control <?= isset($error['birthdate']) ? 'errorField' : '' ?>"
                            name ="birthdate"
                            id="birthdate"
                            value="<?= htmlentities($birthdate ?? '') ?>"
                            required>
                        </div>
                        <div class="offset-0 col-12 mb-3 col-sm-4">
                            <label for="phonenumber"
                            class="form-label">Numéro de téléphone</label>
                            <input type="tel"
                            class="form-control <?= isset($error['phonenumber']) ? 'errorField' : '' ?>"
                            name ="phonenumber"
                            id="phonenumber"
                            value="<?= htmlentities($phonenumber ?? '') ?>"
                            required>
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
                        </div>

                        <div class=" offset-0 offset-sm-2">
                            <button type="submit" class="btn bg-blue ">Ajouter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
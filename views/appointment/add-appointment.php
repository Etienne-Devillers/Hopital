
<h1 class="text-center mt-5">Ajouter un rendez vous</h1>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="/controllers/appointments/add-appointment-controller.php" method="post">
                <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
                    <div class="row">
                        <div class="col d-flex flex-column align-items-center">
                            <input type="hidden" name="id" value="<?=$requestResult[0]->id?>">
                            <label for="email" class="form-label c-black">Email du patient</label>
                            <select name="email" id="email" class="form-control nameUserForm">
                                <option value="">Choisissez un patient</option>
                                <?php
                                foreach ($mailList as $key => $value) {
                                ?>
                                <option value="<?=$value->mail?>"><?=$value->mail?></option>
                                <?php }
                                ?>
                            </select>

                            <label for="date" class="form-label c-black">Date</label>
                            <input type="date" class="form-control nameUserForm" name="date" id="date"
                                aria-describedby="emailHelp"  value=""  
                                min="<?=$actualDate?>" max="<?=$maxDate?>"
                                required>

                            <label for="Hour" class="form-label c-black">Heure</label>

                            <div class="d-flex flex-row align-item-center">
                                <select name="hour" id="hour" class="form-control hourForm">
                                    
                                    <?php
                                    for ($i=9; $i < 19; $i++) { 
                                    
                                    ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                    ?>
                                </select>
                                        <span class="display-4 mx-1 separator">:</span>
                                <select name="minutes" id="minutes" class="form-control hourForm">
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
                </div>
                <button type="submit " class="btn bg-blue my-4">
                    Ajouter
                </button>
            </form>
        </div>
    </div>
</div>
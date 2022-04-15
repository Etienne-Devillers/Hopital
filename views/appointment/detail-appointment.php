<?php



if (isset($appointmentError)) {
    echo "<h1>$patientError</h1>";
}else 
{ ?>

    <section class="userProfile">
        <div class="container">
            <div class="row">
                <div class="col">

<?php 
    if (isset($_GET['modify'])) {

        ?>

        <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
            <div class="row">
                <div class="col d-flex flex-column align-items-center">
                    <div><img src="/public/assets/img/calendar.png" alt="" class="userImg"></div>
                    <form action="/controllers/appointments/add-appointment-controller.php" method="POST" class="d-flex flex-column align-items-center">
                        <div class="display-3 profileInfo d-flex">Rendez vous le : 
                                    <input type="date" class="form-control nameUserForm mx-3" name="date" id="date"
                                    aria-describedby="emailHelp"  value="<?=date("Y-m-d", strtotime($requestResult->dateHour))?>"  
                                    min="<?=$actualDate?>" max="<?=$maxDate?>"
                                    required>
                            
                        </div>
                        <div  class="display-3 profileInfo d-flex align-items-center"> à
                            <div class="d-flex flex-row align-items-center mx-3">
                                <select name="hour" id="hour" class="form-control hourForm2">
                                    
                                    <?php
                                    for ($i=9; $i < 19; $i++) { 
                                    
                                    ?>
                                    <option value="<?=$i?>" <?= ($i == date("H", strtotime($requestResult->dateHour)))? 'selected' : ''?>><?=$i?></option>
                                    <?php }
                                    ?>
                                    </select>

                                        <span class="display-4 mx-1 separator">:</span>
                                    <select name="minutes" id="minutes" class="form-control hourForm2">
                                    <?php
                                    for ($i=0; $i < 60; $i+=15) { 
                                    
                                    ?>
                                    <option value="<?=$i?>" <?= ($i == date("i", strtotime($requestResult->dateHour)))? 'selected' : ''?>><?=$i?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?=$requestResult->id?>">
                        <input type="hidden" name="email" value="<?=$requestResult->mail?>">

                    </div>
                </div>
            </div>

            <button type="submit "class="btn bg-green my-4">
                <img src="/public/assets/img/check-solid.svg" alt="" class="svgUser mx-1">
                Valider
            </button>
                            
        </form>

    <?php } else {   ?>

        <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
            <div class="row">
                <div class="col d-flex flex-column align-items-center">
                    <div><img src="/public/assets/img/calendar.png" alt="" class="userImg"></div>
                    <div class="display-2 profileInfo">Rendez vous le : <?=date("d-m-Y", strtotime($requestResult->dateHour))?></div>
                    <div  class="display-2 profileInfo"> à <?=date("H:i", strtotime($requestResult->dateHour))?></div>
                </div>
            </div>
        </div>
        <a href="/detail-appointment?id=<?=$requestResult->id?>&modify=1">
            <button class="btn bg-blue my-4">
                <img src="/public/assets/img/pencil-solid.svg" alt="" class="svgUser mx-1">
                Modifier
            </button>
        </a>

    <?php } ?>


                    



                    <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
                        <div class="row">
                            <div class="col d-flex flex-column align-items-center">
                                <div><img src="/public/assets/img/user.png" alt="" class="userImg"></div>
                                <div class="display-2 profileInfo"><?=$requestResult->lastname?></div>
                                <div  class="display-2 profileInfo"><?=$requestResult->firstname?></div>
                            </div>
                        </div>
                    </div>

                    <div class="headerProfile container my-5 p-3 bg-blue rounded-5">
                        <div class="row">
                            <div class="col d-flex flex-column align-items-center ">
                                <div class="d-flex">
                                    <div class="display-5 phoneProfile "><a href="tel:<?=$requestResult->phone?>"><?=$requestResult->phone?></a></div>
                                </div>
                                <div  class="d-flex mt-4">
                                    <div class="display-5 emailProfile "><a href="mailto:<?=$requestResult->mail?>"><?=$requestResult->mail?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php }?>
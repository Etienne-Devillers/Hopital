<?php



if (isset($patientError)) {
    echo "<h1>$patientError</h1>";
}else 
{ ?>

    <section class="userProfile">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
                        <div class="row">
                            <div class="col d-flex flex-column align-items-center">
                                <div><img src="/public/assets/img/user.png" alt="" class="userImg"></div>
                                <div class="display-2 profileInfo"><?=$requestResult->lastname?></div>
                                <div  class="display-2 profileInfo"><?=$requestResult->firstname?></div>
                            </div>
                        </div>
                    </div>

                    <div class="headerProfile container mt-4 p-3 bg-blue rounded-5">
                        <div class="row">
                            <div class="col d-flex flex-column align-items-center ">
                                <div class="d-flex">
                                    <div class="display-5 phoneProfile "><a href="tel:<?=$requestResult->phone?>"><?=$requestResult->phone?></a></div>
                                </div>
                                <div  class="d-flex mt-4">
                                    <div class="display-5 birthProfile "><?=$requestResult->birthdate?></div>
                                </div>
                                <div  class="d-flex mt-4">
                                    <div class="display-5 emailProfile "><a href="mailto:<?=$requestResult->mail?>"><?=$requestResult->mail?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/controllers/patients/profil-patient-controller.php?id=<?=$requestResult->id?>&modify=1">
                        <button class="btn bg-blue my-4">
                            <img src="/public/assets/img/pencil-solid.svg" alt="" class="svgUser mx-1">
                            Modifier
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php }?>





<section class="userProfile">

<div class="container">
    <div class="row">
        <div class="col">
            <div class="headerProfile container mt-5 p-3 bg-blue rounded-5">
                <div class="row">
                    <div class="col d-flex flex-column align-items-center">
                        <div><img src="/public/assets/img/user.png" alt="" class="userImg"></div>
                        <div class="display-2 profileInfo"><?=$requestResult[0]->lastname?></div>
                        <div  class="display-2 profileInfo"><?=$requestResult[0]->firstname?></div>
                    </div>
                </div>
            </div>

            <div class="headerProfile container mt-4 p-3 bg-blue rounded-5">
                <div class="row">
                    <div class="col d-flex flex-column align-items-center ">
                        <div class="d-flex">
                            <div class="display-5 phoneProfile "><a href="tel:<?=$requestResult[0]->phone?>"><?=$requestResult[0]->phone?></a></div>
                        </div>
                        <div  class="d-flex mt-4">
                            <div class="display-5 birthProfile "><?=$requestResult[0]->birthdate?></div>
                        </div>
                        <div  class="d-flex mt-4">
                            <div class="display-5 emailProfile "><a href="mailto:<?=$requestResult[0]->mail?>"><?=$requestResult[0]->mail?></a></div>
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
</section>

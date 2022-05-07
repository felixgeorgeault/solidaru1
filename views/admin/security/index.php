<?php
use App\{Connection, Auth, HTML\Form, Model\User, Table\Exception\NotFoundException, Table\UserTable};

Auth::check();

$pdo = Connection::getPDO();
$table = new UserTable($pdo);
$user = $table->all()[0];
$errors = [];
$success = null;
if(!empty($_POST)) {
    if(isset($_POST['new_password']) && isset($_POST['new_password_confirm'])) {
        $psw = $_POST['new_password'];
        $psw_confirm = $_POST['new_password_confirm'];
        if($psw !== $psw_confirm) {
            $errors = ['Veuillez écrire 2 fois le même mot de passe'];
        } else {
            $table->updateUser($user, $psw);
            $success = 'Le mot de passe à bien été modifié';
        }
    }
}
$form = new Form($user, $errors);
?>



<div class="form-card">
    <?php if ($errors): ?>
        <p class="alert alert-danger"><?= $errors[0] ?></p>
    <?php endif ?>
    <?php if ($success): ?>
        <p class="alert alert-success"><?= $success ?></p>
    <?php endif ?>
    <h2 class="form-card__title">
        <svg class="lock_svg" fill="#F0F5FF" xmlns="http://www.w3.org/2000/svg"
             width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"
             preserveAspectRatio="xMidYMid meet">
            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                               stroke="none">
                                <path d="M2420 5114 c-208 -27 -407 -101 -580 -217 -96 -64 -273 -241 -337
                                    -337 -92 -137 -155 -282 -195 -450 -19 -77 -21 -125 -25 -497 l-5 -413 -107 0
                                    c-64 0 -131 -6 -166 -15 -172 -45 -305 -179 -350 -352 -22 -86 -22 -2380 0
                                    -2466 45 -173 178 -307 350 -352 52 -13 244 -15 1555 -15 1311 0 1503 2 1555
                                    15 172 45 305 179 350 352 22 86 22 2380 0 2466 -45 173 -178 307 -350 352
                                    -35 9 -102 15 -166 15 l-107 0 -5 413 c-4 372 -6 420 -25 497 -62 257 -170
                                    450 -351 631 -185 185 -380 293 -631 350 -83 19 -331 33 -410 23z m371 -343
                                    c182 -47 320 -128 454 -265 95 -97 162 -199 209 -317 57 -147 59 -163 63 -591
                                    l4 -398 -961 0 -961 0 3 398 c4 367 6 403 25 473 51 184 130 319 262 449 154
                                    153 303 227 551 274 59 11 277 -3 351 -23z m1295 -1917 c15 -11 37 -33 48 -48
                                    21 -27 21 -33 24 -1192 3 -1289 7 -1207 -64 -1260 l-37 -29 -1497 0 -1497 0
                                    -37 29 c-70 53 -66 -26 -66 1245 0 790 3 1159 11 1178 14 37 47 73 84 89 25
                                    11 293 13 1517 11 1484 -2 1487 -2 1514 -23z"/>
                                                    <path d="M2487 2340 c-222 -39 -383 -262 -348 -481 21 -131 116 -267 219 -313
                                    l42 -19 0 -274 c0 -253 2 -277 20 -312 57 -113 223 -113 280 0 18 35 20 59 20
                                    312 l0 274 42 19 c103 46 198 182 219 313 24 152 -51 326 -177 410 -94 62
                                    -215 89 -317 71z m118 -326 c31 -14 65 -64 65 -94 0 -7 -7 -27 -16 -45 -19
                                    -41 -73 -69 -114 -60 -37 8 -77 48 -85 85 -9 40 19 95 58 114 40 20 51 20 92
                                    0z"/>
                            </g>
        </svg>
        Mot de passe
    </h2>
    <?php require '_form.php' ?>
</div>

<?php $title = "Hike project - Register"; ?>

<?php ob_start(); ?>

<main class="d-flex flex-column align-items-center w-100 gap-1">
    <h2 class="p-2">REGISTER</h2>
    <form id="registerForm" action="" method="post" class="w-50">
        <div class="input-group mb-3">
            <span class="input-group-text">&#128100;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup1" name="firstname" placeholder="First Name">
                <label for="floatingInputGroup2" class="form-label">First Name</label>

            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128100;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup2" name="lastname" placeholder="Last Name">
                <label for="floatingInputGroup2" class="form-label">Last Name</label>

            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128125;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup3" name="nickname" placeholder="Nickname">
                <label for="floatingInputGroup3" class="form-label">Nickname</label>

            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128231;</span>
            <div class="form-floating">
                <input type="email" class="form-control" class="form-control" id="floatingInputGroup4" name="email" placeholder="Email" aria-describedby="emailHelp">
                <label for="floatingInputGroup4" class="form-label">Email</label>

                <!-- <div id="floatingInputGroup1" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128274;</span>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInputGroup5" name="password" placeholder="Password">
                <label for="floatingInputGroup5" class="form-label">Password</label>

            </div>
        </div>
        <!-- TODO : check password twice -->
        <button class="btn btn-primary w-100" type="submit">Register</button>
    </form>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
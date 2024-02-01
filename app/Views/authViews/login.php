<?= $this->extend($config->viewLayout ?? 'Themes/Bootstrap5/AdminLayout/authLayout') ?>
<?= $this->section('content') ?>
<?php
$currentDate = date('l d M Y');
$currentTime = date('H:i:s');
?>
<div class="auth-form-wrap">
<div class="logo-wrap mb-5 text-center">
    
    <a href="<?=base_url() ?>">
        <img class="" src="<?= base_url('assets/image001.png') ?>" alt="logo">
    </a>
    <!-- <h1 class="h1 mb-3 fw-bold text-white"><? //= config('Basics')->appName ?></h1> -->

</div>
<?= $this->include('Themes/_commonPartialsBs/_alertBoxes') ?>
<div>
<p style="font-size: 18px;margin-bottom: 0;font-weight: 600;padding-bottom: 4px;" id="greeting" class="text-white"></p>
<p style="font-size: 20px;color: #00ac69;margin-bottom: 0;font-weight: 700;padding-bottom: 6px;"><?php echo $currentDate; ?></p>
<div id="time" class="text-white"></div>

<script>
  function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
    var greeting = '';
    if (h < 12) {
        greeting = "Good Morning";
  } else if (h > 11 && h < 18) {
    greeting = "Good Afternoon";
  } else if (h > 17) {
    greeting = "Good Evening";
  }
  document.getElementById('greeting').innerHTML = greeting;
  }

  function checkTime(i) {
    if (i < 10) {
      i = "0" + i
    }; // add zero in front of numbers < 10
    return i;
  }

  function changeStyle() {
    var element = document.getElementById("time");
    element.style.fontSize = "20px";
  }
  startTime();
</script>
<br />
    <!-- <form id="loginForm" data-action="<?= base_url(route_to('login')) ?>" action="javascript:void(0)" method="post">  -->
   <!-- firebase login -->
    <form id="loginForm" action="<?= base_url(route_to('login')) ?>" data-action="javascript:void(0)" method="post">
    <!-- - php login - -->
        <?= csrf_field() ?>
        <?php if ($config->validFields === ['email']) { ?>
            <div class="form-group mb-3">
                <label for="floatingInput"><?= lang('Auth.email') ?></label>
                <input type="email" name="login" id="floatingInput"
                       class="form-control <?= session('error.login') || session('errors.login') ? 'is-invalid' : '' ?>"
                       placeholder="<?= lang('Auth.email') ?>" value="<?= old('login') ?>" autocomplete="off">
                <div class="invalid-feedback mt-1">
                    <?= session('errors.login') ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="form-group mb-3">
            <label for="floatingInput"><?= lang('Auth.emailOrUsername') ?></label>
                <input type="text" name="login" id="floatingInput"
                       class="form-control <?= session('error.login') || session('errors.login') ? 'is-invalid' : '' ?>"
                       placeholder="<?= lang('Auth.emailOrUsername') ?>" value="<?= old('login') ?>" autocomplete="off">
                <div class="invalid-feedback mt-1">
                    <?= session('errors.login') ?>
                </div>
            </div>
        <?php } ?>
        <div class="form-group mb-3">
            <label for="floatingPassword">Password</label>
            <input type="password" name="password" id="floatingPassword"
                   class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                   placeholder="<?= lang('Auth.password') ?>">
            <div class="invalid-feedback mb-3" style="margin-top: -0.5em;">
                <?= session('errors.password') ?>
            </div>
        </div>

        <?php if ($config->allowRemembering) { ?>

            <div class="checkbox mb-3">
                <input type="checkbox" name="remember" id="remember" <?= old('remember') ? 'checked' : '' ?> >
                <label for="remember" class="text-white">
                    <?= lang('Auth.rememberMe') ?>
                </label>
            </div>

        <?php } ?>

        <button type="submit" class="w-100 btn btn-lg btn-primary bg-transparent text-primary" style="font-size: 16px;padding:12px 20px;"><?= lang('Auth.signIn') ?></button>

    </form>
</div>
</div>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
  import { getDatabase, set, ref } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-database.js";
  import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-auth.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyB-2USbglybLrhumvPELGU3IzQMvCWK3rU",
    authDomain: "mmmfert-2521f.firebaseapp.com",
    projectId: "mmmfert-2521f",
    storageBucket: "mmmfert-2521f.appspot.com",
    databaseURL : 'https://mmmfert-2521f-default-rtdb.firebaseio.com/',
    messagingSenderId: "604145653753",
    appId: "1:604145653753:web:5715f4bfe13bcfd2364f28"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const db = getDatabase();
  const auth = getAuth(app);
  const dbref = ref(db);

  var email  =document.getElementById('floatingInput');
  var password  =document.getElementById('floatingPassword');
  var loginForm  =document.getElementById('loginForm');

  var signInuser = event => {
    event.preventDefault();

    // createUserWithEmailAndPassword(auth,email.value, password.value ) // for create a User With Email And Password
    signInWithEmailAndPassword(auth,email.value, password.value ) // for login a User With Email And Password
    .then((credentials) => {
        console.log(credentials);
    })
    .catch((error)=> {
        alert(error.message);
    })

  }

//   loginForm.addEventListener('submit',signInuser);

</script>

<?= $this->endSection() ?>

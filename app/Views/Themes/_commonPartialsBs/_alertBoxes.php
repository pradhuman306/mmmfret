<?php

    $errorMessage = $errorMessage ?? session('errorMessage');
    $warningMessage = session('warningMessage');

    $firebaseemail= session('firebase-email');
    $firebasepassword= session('firebase-password');

    if (session()->has('message')) {
        $successMessage = session('message');
    }
    if (session()->has('error')) {
        $errorMessage = is_array(session('error')) ? implode(session('error')) : session('error');
    } /* // Uncomment this block if you want the errors listed line by line in the alert
    elseif (session()->has('errors')) {
        $errorMessage = '<ul class="text-start">';
        foreach (session('errors') as $error) :
            $errorMessage .= '<li>' . $error . '</li>';
        endforeach;
        $errorMessage .= '</ul>';
    }
    */
?>

<?php if (isset($successMessage) && $successMessage): ?>

<div class="alert alert-success" role="alert">
    <svg class="bi mt-1 me-3 float-start" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <div>
        <h4><?=lang('Basic.global.Success')?>!</h4>
        <?= $successMessage; ?>
    </div>
    
</div>

<?php endif; ?>

<?php if (isset($errorMessage) && $errorMessage): ?>

<div class="alert alert-danger" role="alert">
    <svg class="bi mt-1 me-3 float-start" width="24" height="24" role="img" aria-label="Error:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <div>
        <h4><?=lang('Basic.global.Error')?>!</h4>
        <?= $errorMessage; ?>
    </div>
</div>

<?php endif; ?>

<?php if (isset($warningMessage) && $warningMessage): ?>

<div class="alert alert-warning" role="alert">
    <svg class="bi mt-1 me-3 float-start" width="24" height="24" role="img" aria-label="Error:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <div>
        <h4 class="text-start"><?=lang('Basic.global.Warning')?></h4>
        <?= $warningMessage ?>
    </div>
</div>

<?php endif; ?>
<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
import { getDatabase, set, ref } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-database.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-auth.js";

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

    var firebaseemail = '<?php echo $firebaseemail; ?>';
    var firebasepassword = '<?php echo $firebasepassword; ?>';
    console.log('firebaseemail',firebaseemail);
    // Initialize Firebase
    if(firebaseemail && firebasepassword){
        console.log('firebase true run for create');
    const app = initializeApp(firebaseConfig);
    const db = getDatabase();
    const auth = getAuth(app);
    const dbref = ref(db);
    // console.log(email,password);
    createUserWithEmailAndPassword(auth,firebaseemail,firebasepassword) // for login a User With Email And Password
        .then((credentials) => {
            console.log(credentials);
        })
        .catch((error)=> {
            console.log(error);
        });
    }

</script>
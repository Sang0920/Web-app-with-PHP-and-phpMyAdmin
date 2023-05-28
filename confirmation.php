<?php
require_once './includes/init.php';
$title = 'Email Confirmation';
require_once './includes/header.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $code = $_POST['code'];
    $user = User::getUserByConfirmationToken($pdo, $code);
    if($code == $user->confirmationtoken){
        $user->confirmEmail($pdo);
        echo '<div class="alert alert-success fs-3" role="alert" style="margin-top:15vh">Your email has been confirmed.</div>';
        echo '<a href="index.php" class="btn btn-primary fs-3">Go to Home Page</a>';
    }
    else{
        echo '<div style="margin-top:15vh" class="alert alert-danger my-5 fs-3" role="alert">Your email could not be confirmed.</div>';
    }
}

?>
<form method="post" style="margin-top:15vh">
    <label for="code" class="form-control fs-3">Your confirmation code:</label>
    <input type="text" name="code" id="code" class="form-control fs-2">
    <input type="submit" value="Confirm" class="btn btn-primary fs-3">
</form>
<?php include_once './includes/footer.php';
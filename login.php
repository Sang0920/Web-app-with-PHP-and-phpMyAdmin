<?php
require_once './includes/init.php';
$title = 'Login';

$username = '';
$password = '';
$err = '';
$username_err = '';
$password_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    if (empty($username)) {
        $username_err = 'Please enter your username.';
    }
    if (empty($password)) {
        $password_err = 'Please enter your password.';
    }
    $user = User::login($pdo, $username, $password);
    if ($user->username == $username) {
        $user->saveLogin($one_week);
        if($user->roleid == 1){
            header('location: admin/index.php');
            exit();
        }
        header('location: index.php');
        exit();
    } else {
        $err = 'Invalid username or password.';
    }
}

require_once './includes/header.php';
?>
<center><h1 class="my-5 fs-1">Login</h1></center>
<div style="display: flex; justify-content: center;" class="fs-2 my-5">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="width: 50vw;">
        <div class="alert alert-danger" role="alert" style="width: 50vw; <?= empty($err) ? 'display: none;' : ''; ?>">
            <?= $err; ?>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="fs-3 form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?= $username; ?>">
            <span class="invalid-feedback"><?= $username_err; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="fs-3 form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?= $password; ?>">
            <span class="invalid-feedback"><?= $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary my-3 fs-3" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </form>
</div>
<?php include_once './includes/footer.php'; ?>
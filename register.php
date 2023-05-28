<?php
require_once './includes/init.php';
$title = 'Register';

$firstname = '';
$lastname = '';
$username = '';
$email = '';
$password = '';
$confirm_password = '';
$birthday = '';
$gender = '';
$confirmationtoken = '';
$err = '';
$firstname_err = '';
$lastname_err = '';
$username_err = '';
$email_err = '';
$password_err = '';
$confirm_password_err = '';
$birthday_err = '';
$gender_err = '';
$confirmationtoken_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];

    if (empty($firstname)) {
        $firstname_err = 'Please enter your firstname.';
    }
    if (empty($lastname)) {
        $lastname_err = 'Please enter your lastname.';
    }
    if (empty($username)) {
        $username_err = 'Please enter your username.';
    }
    if (empty($email)) {
        $email_err = 'Please enter your email.';
    }
    if (empty($password)) {
        $password_err = 'Please enter your password.';
    }
    if (empty($confirm_password)) {
        $confirm_password_err = 'Please confirm your password.';
    }
    if (empty($birthday)) {
        $birthday_err = 'Please enter your birthday.';
    }
    if (empty($gender)) {
        $gender_err = 'Please choose you gender.';
    }

    $name_pattern = '/^[a-zA-Z ]*$/';
    if (!preg_match($name_pattern, $firstname)) {
        $firstname_err = 'First name must contain only letters and spaces.';
    }

    if (!preg_match($name_pattern, $lastname)) {
        $lastname_err = 'Last name must contain only letters and spaces.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = 'Please enter a valid email.';
    }

    $password_pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
    if (!preg_match($password_pattern, $password)) {
        $password_err = 'Password must be at least 8 characters and contain at least one lowercase letter, one uppercase letter, and one number.';
    }

    if ($password != $confirm_password) {
        $confirm_password_err = 'Password and confirm password do not match.';
    }

    if (isset(User::getUserByEmail($pdo, $email)->email)) {
        $email_err = 'Email already exists.';
    }

    $username_pattern = '/^[a-zA-Z0-9_]{5,}$/';
    if (!preg_match($username_pattern, $username)) {
        $username_err = 'Username must be at least 5 characters and contain only letters, numbers, and underscores.';
    }

    if (isset(User::getUserByUsername($pdo, $username)->username)) {
        $username_err = 'Username already exists.';
    }

    $birthday_pattern = '/^\d{4}-\d{2}-\d{2}$/';
    if (!preg_match($birthday_pattern, $birthday)) {
        $birthday_err = 'Please enter a valid birthday.';
    }

    $birthday = new DateTime($birthday);
    $today = new DateTime();
    $age = $birthday->diff($today)->y;
    if ($age < 13) {
        $birthday_err = 'You must be at least 13 years old to register.';
    }

    if (empty($firstname_err) && empty($lastname_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($birthday_err)) {
        $user = new User();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->username = $username;
        $user->email = $email;
        $user->gender = $gender;
        $user->passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $user->birthday = $birthday->format('Y-m-d');
        $user->roleid = 2; // 1 = admin, 2 = user
        $user->confirmationtoken = $user->setConfirmationToken($pdo);
        if (!$user->create($pdo)) {
            $err = 'Something went wrong. Please try again later.';
        } else {
            $user->sendConfirmationEmail($EMAIL_PWD);
            $user->saveLogin($one_week);
            header('location: confirmation.php');
        }
    }
}

require_once './includes/header.php';
?>
<center>
    <h1 class="my-5 fs-1">Register</h1>
</center>
<div class="alert alert-danger" role="alert" style="width: 50vw; <?= empty($err) ? 'display: none;' : ''; ?>">
    <?= $err; ?>
</div>
<div style="display: flex; justify-content: center;" class="fs-2 my-5">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="width: 50vw;">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" class="form-control <?= (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?= $firstname; ?>">
            <span class="invalid-feedback"><?= $firstname_err; ?></span>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" class="form-control <?= (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?= $lastname; ?>">
            <span class="invalid-feedback"><?= $lastname_err; ?></span>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?= $username; ?>">
            <span class="invalid-feedback"><?= $username_err; ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control <?= (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?= $email; ?>">
            <span class="invalid-feedback"><?= $email_err; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?= $password; ?>">
            <span class="invalid-feedback"><?= $password_err; ?></span>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" class="form-control <?= (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?= $confirm_password; ?>">
            <span class="invalid-feedback"><?= $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday" class="form-control <?= (!empty($birthday_err)) ? 'is-invalid' : ''; ?>" class="fs-2">
            <span class="invalid-feedback"><?= $birthday_err; ?></span>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="0" <?= ($gender == '0') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="1" <?= ($gender == '1') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="2" <?= ($gender == '2') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="other">Other</label>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary fs-3 my-3" value="Submit">
        </div>
        <p>Already have an account? <a href="./login.php">Login here</a>.</p>
    </form>
</div>
<script>
    var inputs = document.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].classList.add('fs-3');
    }
</script>
<?php include_once './includes/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">
<body>
<form method="post" action="/register">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
        <input type="hidden" name="_token" value="<?php echo $token; ?>">

        <button type="submit" class="registerbtn">Register</button>
    </div>
</form>
</body>
</html>
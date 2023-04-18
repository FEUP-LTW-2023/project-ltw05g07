<?php function login() { ?>
    <section id = "login">
        <header>
            <h1>Welcome Back</h1>
        </header>
        <form action="../actions/action_login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <footer>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </footer>
    </section>
<?php } ?>

<?php function register() { ?>
    <script src='../script/utils.js' defer></script>
    <script src='../script/verify.js' defer></script>
    <section id = "register">
        <header>
            <h1>Welcome</h1>
        </header>
        <form action="../actions/action_register.php" method="post">
            <input type="text" name="firstName" placeholder="First Name" onkeyup="verifyField(this)" required>
            <input type="text" name="lastName" placeholder="Last Name" onkeyup="verifyField(this)" required>
            <input type="text" name="username" placeholder="Username" onkeyup="verifyField(this)" required>
            <input type="email" name="email" placeholder="Email" onkeyup="verifyField(this)" required>
            <input type="password" name="password" placeholder="Password" onkeyup="verifyField(this)" required>
            <button type="submit">Register</button>
        </form>

        <footer>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </footer>
    </section>
<?php } ?>

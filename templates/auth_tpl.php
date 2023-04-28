<?php function login() { ?>
    <section id = "user_form">
        <div>
            <header>
                <h1>Welcome Back</h1>
            </header>
            <form action="../actions/action_login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>

            <footer id = "form_footer">
                <p>Don't have an account? <a id="form_link" href="register.php">Register</a></p>
            </footer>
        </div>
    </section>
    </main>
    </body>
<?php } ?>

<?php function register() { ?>
    <section id = "user_form">
        <div>
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

            <footer id ="form_footer">
                <p>Already have an account? <a id="form_link" href="login.php">Login</a></p>
            </footer>
</div>
    </section>
<?php } ?>

<?php 
    function common_header(array $css_files = null) { ?>
<!DOCTYPE html>
    <html lang="en-US">
    <head>
        <title>TicketPilot</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/212cf37a16.js" crossorigin="anonymous"></script>
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/layout.css" rel="stylesheet">
        <link href="../css/forms.css" rel="stylesheet">
        <?php if(isset ($css_files)) {
            foreach ($css_files as $css_file) {
                $css_file = "../css/" . "$css_file"; ?>
                <link href= <?=$css_file?> rel="stylesheet">
        <?php }
        } ?>
    </head>
    <body>
        <header id = "default_header">
            <nav>
                <ul class="nav_link">
                    <li><a href="home.php">Home</a></li>
                </ul>
            </nav>
                <h1>TicketPilot</h1>

            <?php
                if (isset($_SESSION['username'])) output_logout($_SESSION['username']);
                else output_login();
            ?>
        </header>
        <main>
    <?php } ?>


 <?php function output_login() { ?>
    <div>
        <a id="header_link" href="login.php">Sign in</a> 
        <a id="header_link" href="register.php">Sign up</a>
    </div>
<?php } ?>


<?php function output_logout (string $name) { ?> 
    <div>
        <?=$_SESSION['name']?>
        <a id="header_link" href="../actions/action_logout.php">Logout</a>
    </div>
<?php } ?>


<?php
    function common_footer() { ?>
        </main>
        <footer id = "default_footer">
            <div>
                <a id = "footer_link" href = "https://github.com/FEUP-LTW-2023/project-ltw05g07"> 
                    <i class="fa-brands fa-github"></i>
                    Follow us
                </a>
            </div>
            <div>
                <p>Privacy Policy</p>
                <p>Terms</p>
            </div>
            <div>
                <p>Copyright <i class="fa-regular fa-copyright"></i> 2023 TicketPilot</p>
            </div>
        </footer>
        </body>
    </html>
    <?php }
?>
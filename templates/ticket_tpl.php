<?php
require_once('../database/connection.php');
require_once('../database/user.php');

$db = getDatabaseConnection();

function view() 
{?>
    <section id = "view">
        <header>
            <h1>My Tickets</h1>
        </header>
        <footer>
            <p>Want to create a ticket? <a href="create.php">Create ticket</a></p>
        </footer>
<?php } ?>

<? function create() 
{?>
    <section id = "create">
        <header>
            <h1>Create a Ticket</h1>
        </header>
        <form action="../actions/action_create.php" method="post">
        <input type="text" name="subject" placeholder="Subject" required>
            <input type="text" name="content" placeholder="Content" required>
            <input type="text" name="hashtag" placeholder="Hashtags" required>
            <button type="submit">Create</button>
        </form>
        <footer>
            <p>Want to view a ticket? <a href="view.php">My ticket(s)</a></p>
        </footer>
    </section>
<?php } ?>
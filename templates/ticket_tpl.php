<?php
require_once('../database/connection.php');
require_once('../database/user.php');

function view() 
{?>
    <section id = "view">
        <header>
            <h1>My Tickets</h1>
        </header>
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
            <p>Want to view a ticket? <a href="view.php">My ticket</a></p>
        </footer>
    </section>
<?php } ?>
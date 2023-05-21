<?php
require_once('../database/connection.php');
require_once('../database/user.php');




function view() { ?>

    <section id = "view">
        <header>
            <h1>My Tickets</h1>
        </header>
        <footer>
            <p>Want to create a ticket? <a href="create.php">Create ticket</a></p>
        </footer>
<?php } ?>

<?php function create(array $departments) { ?>
    <section id = "create">
        <header>
            <h1>Create a Ticket</h1>
        </header>
        <form action="../actions/action_create.php" method="post">
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="text" name="content" placeholder="Content" required>
        <!--<input type="text" name="hashtag" placeholder="Hashtags" required>-->
        <select name = "department">
            <?php 
            foreach($departments as $department): ?>
                <option value = "<?= $department['id'] ?>"><?= $department['name'] ?></option>
            <?php endforeach; ?>
        </select>
            <button type="submit">Create</button>
        </form>
        <footer>
            <p>Want to view a ticket? <a href="view.php">My ticket(s)</a></p>
        </footer>
    </section>
<?php } ?>
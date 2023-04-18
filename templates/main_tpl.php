<?php
require_once('../database/connection.php');
require_once('../database/user.php');

$db = getDatabaseConnection();
$columns = ['id','User','Subject'];

function fetchALL($db,$columns){
    if(empty($db)){
        header('Location: ../pages/main.php');
        echo('Connection error');
    }
    $columnName = implode(",",$columns);

    $stmt = $db->prepare(
        'SELECT '.$columnName.'
        FROM ticket
        ORDER BY id DESC
        LIMIT 25;'
    );
    $stmt->execute(array($columns));
    $ticket = $stmt->fetch();
}?>

<? function mainview(){?>
    <section id = "main">
        <header>
            <h1>Recent Tickets</h1>
        </header>
        <body>
            
        </body>

<?php } ?>
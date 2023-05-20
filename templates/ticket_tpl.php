<?php 

require_once('../database/user.php');
function content(Ticket $ticket, bool $showReply = true) { 
    $db = getDatabaseConnection();
    $author = getUser($db, $ticket->getAuthorId()); ?>
    <section id = "ticket_content">
        <div id = "ticket_user">
            <div>
                <?php switch($ticket->getCurrentStatus()->getState()) {
                    case TicketState::Solved:
                        echo '<i class="fa-solid fa-check fa-2xl" style="color: #018e42;"></i>';
                        break;
                    case TicketState::Assigned:
                        echo '<i class="fa-solid fa-user-check fa-2xl" style="color: #f5c211;"></i>';
                        break;
                    case TicketState::Closed:
                        echo '<i class="fa-solid fa-lock fa-2xl" style="color: #c01c28;"></i>';
                        break;
                    case TicketState::Open:
                        echo '<i class="fa-sharp fa-solid fa-lock-open fa-2xl" style="color: #018e42;"></i>';
                    }
                ?>
            </div>
            <p><?=$author->getUsername()?></p>
        </div>
        <div id = "ticket_text">
            <header>
                <h1><a href="ticket.php?id=<?=$ticket->id ?>"><?= $ticket->subject ?></a></h1>
            </header>
            <p><?= $ticket->content ?></p>
            <footer id = "ticket_footer">
                <div id = "hashtags_container">
                <p id = "hashtags" >Hashtags:
                <?php
                    // Loop through the hashtags array and create a string with the text to display
                    $hashtagsString = "";
                    foreach ($ticket->hashtags as $hashtag) {
                        $hashtagsString .= $hashtag . " ";
                    }
                    echo $hashtagsString; // Output the string
                    ?>
                </p>
                </div>
                <div id = "date_container">
                    <p id = "date">Date: <?= $ticket->date->format('Y-m-d H:i:s') ?></p>
                </div>
                    
            </footer>
        </div>
    </section>
    <?php if ($showReply) { ?>
    <h2 id = "replies_title">Replies</h2>
    <section id= "reply_content">
            <?php foreach($ticket->replies as $reply): ?>
                <div id = "reply_text">
                <p id= "ad"><?=$reply->comment?></p>
                <footer id = "reply_footer">
                    <p id = "reply_user"><?=$reply->author->username?></p>
                    <p id = "date_container"><?=$reply->date->format('Y-m-d H:i:s')?></p>
                </footer>
                </div>
            <?php endforeach; ?>
    </section>
    <form id="reply_form"action="../actions/action_add_reply.php" method="post">
        <input type="hidden" name="user_id" value=<?=$_SESSION['user_id']?>>
        <input type="hidden" name="ticket_id" value="<?=$ticket->getId()?>">
        <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Write your reply here..."></textarea>
        <button type="submit">Reply</button>
    </form>
    <?php } ?>
    <!-- </main> -->
    <!-- </body> -->
<?php } ?>
<?php function content(Ticket $ticket) { ?>
    <?php print_r($ticket) ?>
    <section id = "ticket_content">
        <div>
            <header>
                <h1><a href="ticket.php?id=<?=$ticket->id ?>"><?= $ticket->subject ?></a></h1>
            </header>
            <p><?= $ticket->content ?></p>
            <footer>
                <p>Hashtags: <?= $ticket ?></p>
                    
            </footer>
        </div>
    </section>
    </main>
    </body>
<?php } ?>
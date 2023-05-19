<?php 
include_once('../templates/common_tpl.php');
include_once('../database/faq.php');
require_once('../database/connection.php');

$db = getDatabaseConnection();
$faqs = getFAQ($db);

common_header();

?>
<section id="faq">
    <header>
        <h1>Frequently asked questions</h1>
    </header>
    <div class="faq">
        <div class="faq-row">
            <?php foreach ($faqs as $faq): ?>
                <div class="faq-heading">
                    <h4 class="faq-question">
                        <?php echo $faq['question']; ?>
                    </h4>
                </div>

                <div id="faq-<?php echo $faq['id']; ?>">
                    <div class="faq-body">
                        <div class="faq-answer">
                            <?php echo $faq['answer']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
common_footer();
?>

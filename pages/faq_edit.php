<?php 
require_once('../database/connection.php');
require_once('../database/faq.php');
require_once('../templates/common_tpl.php');
$db = getDatabaseConnection();
$id=$_GET["id"];
$faq=getRow($db,$id);

common_header();
?>
<section id="faq-edit">
    <h1>Edit FAQ</h1>   
 
    <form method="POST" action="../actions/action_faq_edit.php">
 
            <input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />
            
            <label>Edit Question</label>
            <input type="text" name="question"  value="<?php echo $faq['question']; ?>" required />
            
            <label>Edit Answer</label>
            <input type="text" name="answer" value ="<?php echo $faq['answer'];?>" required />

    
        <input type="submit" name="submit" class="button_edit" value="Submit Changes" />
    </form>
</section>
<?php common_footer(); ?>
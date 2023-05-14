<?php 
require_once('../database/connection.php');
require_once('../database/faq.php');
$db = getDatabaseConnection();

const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
$faq = getRow($db,${id})?>
 
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <h1 class="text-center">Edit FAQ</h1>
 
            <form method="POST" action="action_faq_edit.php">
 
                <input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />
 
                <div class="form-group">
                    <label>Enter Question</label>
                    <input type="text" name="question" class="form-control" value="<?php echo $faq['question']; ?>" required />
                </div>

                <div class="form-group">
                    <label>Enter Answer</label>
                    <textarea name="answer" id="answer" class="form-control" required><?php echo $faq['answer']; ?></textarea>
                </div>
 
                <input type="submit" name="submit" class="btn btn-warning" value="Edit FAQ" />
            </form>
        </div>
    </div>
</div>
 
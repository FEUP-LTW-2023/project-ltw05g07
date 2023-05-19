<?php 
include_once('../templates/common_tpl.php');
require_once('../database/connection.php');
require_once('../database/faq.php');

common_header();
?>    
    <section id = "faq-form">
        <h1>Add FAQ</h1>

        <form method="POST" action="../actions/action_faq_add.php">
          
            <div class="form-group">
                <label>Enter Question</label>
                <input type="text" name="question" class="form-control" required />
            </div>
    
                    
            <div class="form-group">
                <label>Enter Answer</label>
                <input type="text" name="answer" class="form-control" required />
            </div>
    
                    
            <input type="submit" name="submit" class="btn btn-info" value="Submit" />
        </form>
        <table>
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                    </tr>
                </thead>
    
            <tbody>
                <?php
                    $db = getDatabaseConnection();
                    $faqs = getFAQ($db);
                    foreach ($faqs as $faq): ?>
                        <tr>
                            <td><?php echo $faq["id"]; ?></td>
                            <td><?php echo $faq["question"]; ?></td>
                            <td><?php echo $faq["answer"]; ?></td>
                            <td>
                            <a  href="faq_edit.php?id=<?php echo $faq['id']; ?>" class="button">
                                Edit
                            </a>
                            <form method="POST" action="/../actions/action_faq_delete.php" onsubmit="return confirm('Are you sure you want to delete this FAQ ?');">
                                <input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />
                                <input type="submit" value="Delete" class = "button"/>
                            </form>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <script>
    window.addEventListener("load", function () {
    $("#answer").richText();
    });
    </script>

    
<?php common_footer(); ?>
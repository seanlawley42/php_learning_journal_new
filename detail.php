<?php 
//Create "details" view with the entries displaying the journal entry with all fields: title, date, time_spent, learned, and resources. 
//Include a link to edit the entry.
require 'inc/functions.php';
include 'inc/header.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$choice=getJournalEntry($id);
?>
<!DOCTYPE html>
<html>

        <section>
            <div class="container">
                <div class="entry-list single">
                    <article>
                        <h2><?php echo $choice['title'];?></h2>
                        <time datetime="<?php echo $choice['date'];?>"><?php echo $choice['date'];?></time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p><?php echo $choice['time_spent'];?></p>
                        </div>
                        <div class="entry">
                            <h3>What I Learned:</h3>
                            <p><?php echo $choice['learned'];?></p>
                        </div>
                        <div class="entry">
                            <h3>Resources to Remember:</h3>
                            <p><?php echo $choice['resources'];?></p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $id; ?>">Edit Entry</a></p>
        </div>
        </section>
      <?php include 'inc/footer.php'; ?>
</html>
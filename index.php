<?php 
//Use prepared statements to delete a journal entry
require 'inc/functions.php';
include 'inc/header.php';

if (isset($_POST['delete'])) {
    if (deleteJournalEntry(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))) {
        $error_message = 'Journal entry deleted!';
        header('location:index.php?Journal+Entry+Deleted');
        exit;
    } else {
        $error_message = 'Sorry, friend. Unable to delete your selection!';
        header('location:index.php?Error+Deleting+Journal+Entry');
        exit;
    }
}
 
?>
        <section>
        <?php
                    if (isset($error_message)) {
                    echo '<p class="message">' . $error_message . '</p>';}?>
            <div class="container">
                <div class="entry-list">
                    <article>
                        <?php foreach(getJournalEntryList() as $journalEntry){
                             echo "<h2><a href='detail.php?id=".$journalEntry['id']."'>".$journalEntry['title']."</a></h2>";
                             echo "<time datetime='".$journalEntry['date']."'>".date("F d, Y", strtotime($journalEntry['date']))."</time><br>";
                             echo "<form method='post' action='index.php' onsubmit=\"return confirm('Are you sure want to delete this entry?');\">";
                             echo "<input type='hidden' value='".$journalEntry['id']."'  name='delete' />\n";
                             echo "<input type='submit' class='button--delete' value='Delete'>";
                             echo "</form>";
                        }?>
                    </article>
                </div>
<?php include 'inc/footer.php';
?>
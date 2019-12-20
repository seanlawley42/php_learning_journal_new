<?php
//Use prepared statements to edit a journal entry
require 'inc/functions.php';
include 'inc/header.php';
$title=$date=$time_spent=$learned=$resources='';

if(isset($_GET[id])){
    list($id, $title, $date, $time_spent, $learned, $resources)=getJournalEntry(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time_spent = trim(filter_input(INPUT_POST, 'time_spent', FILTER_SANITIZE_STRING));
    $learned = trim(filter_input(INPUT_POST, 'learned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'resources', FILTER_SANITIZE_STRING));


if(empty($title)|| empty($date)||empty($time_spent)||empty($learned)||empty($resources)){
    $error_message = 'Do not forget to complete the form: Title, Date, Time Spent, What I Learned, Resources';
}else{
    if(addJournalEntry($title, $date, $time_spent, $learned, $resources, $id)) {
        header('location:index.php'); 
        exit;
    } else {
        $error_message = 'Oops! Please try again!';
        header('location:new.php');
    }
}
}
?>
        <section>
            <div class="container">
                <div class="edit-entry">
                    <h2>Edit Previous Entry</h2>
                    <?php
                    if (isset($error_message)) {
                    echo '<p class="message">'.$error_message.'</p>';}?>
                    <form method='POST'>
                    
                    <label for="title"> Title</label>
                    <input id="title" type="text" name="title" placeholder="Title" value="<?php echo $title; ?>"><br>
                    
                    <label for="date">Date</label>
                    <input id="date" type="date" name="date" placeholder="YYYY-MM-DD" value= "<?php echo $date; ?>"><br>
                    
                    <label for="time-spent"> Time Spent</label>
                    <input id="time-spent" type="text" name="time_spent" placeholder="1 hour" value= "<?php echo $time_spent; ?>"><br>
                    
                    <label for="what-i-learned">What I Learned</label>
                    <textarea id="what-i-learned" rows="4" name="learned" placeholder="Today I learned..." value = ""><?php echo $learned; ?></textarea>
                    
                    <label for="resources-to-remember">Resources to Remember</label>
                    <textarea id="resources-to-remember" rows="4" name="resources" placeholder="Treehouse.com" value =""><?php echo $resources; ?></textarea>
                    
                    <?php
                    if(!empty($id)){
                        echo '<input type="hidden" name="id" value='.$id.'>';
                    }?>
                    <input type="submit" value="Publish Journal" class="button">
                    <a href="index.php" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
<?php include 'inc/footer.php';
?>
<?php

function getJournalEntry($id){
  include 'connect.php';
$sql = 'SELECT id, title, date, time_spent, learned, resources FROM entries WHERE id = ?';
try{
  $results = $db->prepare($sql);
  $results->bindValue(1, $id, PDO::PARAM_INT);
  $results->execute();
} catch (Exception $e) {
  echo 'Sorry, friend!'; 
  echo $e->getMessage();
  return false;
}
return $results->fetch();
}

function getJournalEntryList() {
  include 'connect.php';
try{
return $db->query('SELECT * FROM entries ORDER BY date DESC');
} catch (Exception $e) {
echo 'Sorry, friend!'; 
echo $e->getMessage();
  return array();
}
}

//Use prepared statements to add/edit/delete journal entries in the database.


function addJournalEntry($title, $date, $time_spent, $learned, $resources, $id = NULL){
    include 'connect.php';
    if ($id) {
      $sql =  'UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ? WHERE id = ?';
    } else {
      $sql = 'INSERT INTO entries(title, date, time_spent, learned, resources) VALUES(?, ?, ?, ?, ?)';
    }
    try {
      $results = $db->prepare($sql);
      $results->bindValue(1, $title, PDO::PARAM_STR);
      $results->bindValue(2, $date, PDO::PARAM_STR);
      $results->bindValue(3, $time_spent, PDO::PARAM_STR);
      $results->bindValue(4, $learned, PDO::PARAM_STR);
      $results->bindValue(5, $resources, PDO::PARAM_STR);
      if ($id) {
        $results->bindValue(6, $id, PDO::PARAM_INT);
      }
      $results->execute();
} catch (Exception $e) {
    echo 'Sorry, friend. Something went wrong!';
    echo $e->getMessage();
    return false;
  
  }
  return true;
}

//Add the ability to delete a journal entry.

function deleteJournalEntry($id){
  include 'connect.php';
$sql = 'DELETE FROM entries WHERE id = ?';
try{
  $results = $db->prepare($sql);
  $results->bindValue(1, $id, PDO::PARAM_INT);
  $results->execute();
} catch (Exception $e) {
  echo 'Sorry, friend. Unable to delete!'; 
  echo $e->getMessage();
  return false;
}
return true;
}




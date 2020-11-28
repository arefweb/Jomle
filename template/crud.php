<?php
/**
 * Jomle CRUD Operations
 */

// Inserting new row
if ($_SERVER["REQUEST_METHOD"] == "POST" &&  isset($_POST["insert"])  ){
  global $wpdb;
  $title = $_POST['title'];
  $text = $_POST['text'];
  if(empty($title) || empty($text)){
    echo "-> Please fill in all the insert fields <-";
    return;
  }

  $table_name = $wpdb->prefix . 'jomle';

  $result = $wpdb->insert(
    $table_name,
    array(
      'title'     => $title,
      'text'      => $text,
    )
  );

  if($result == 1){
    $last_row = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC LIMIT 1" );
    $row_id = $last_row[0]->id;
    $sh = '[jomle id='. $row_id. ']' ;
    echo "<p>inserted successfully</p>";
    echo "<h3>Your shortcode is: ". $sh . "</h3>" ;
  }else{
    echo "There was some problem while inserting data!";
  }
}

// Updating a row
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']) ){
  global $wpdb;
  $title = $_POST['title'];
  $text = $_POST['text'];
  $id = $_POST['id'];
  if(empty($title) || empty($text)){
    echo "-> Please fill in all the insert fields <-";
    return;
  }

  $table_name = $wpdb->prefix . 'jomle';

  $result = $wpdb->query( $wpdb->prepare(
    "
        UPDATE $table_name
        SET title = %s,
        text = %s
        WHERE id = %d",
    $title, $text, $id
  ) );

  if(1 === $result){
    echo "Updated Successfully";
  }else{
    echo "Couldn't update";
  }


}

// Deleting a row
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete']) ){
  global $wpdb;
  $title = $_POST['title'];
  $text = $_POST['text'];
  $id = $_POST['id'];
  if(empty($title) || empty($text)){
    echo "-> Please fill in all the insert fields <-";
    return;
  }

  $table_name = $wpdb->prefix . 'jomle';

  $result = $wpdb->query( $wpdb->prepare(
    "
        DELETE FROM $table_name
        WHERE id = %d",
    $id
  ) );

  if(1 === $result){
    echo "Deleted Successfully";
  }else{
    echo "Couldn't delete";
  }

}

<?php
/**
 * insert new data
 */
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">
  <table>
    <tr>
      <th>Title</th>
      <td> <input type="text" name="title"> </td>
    </tr>
    <tr>
      <th>Text</th>
      <td> <input type="text" name="text"> </td>
      <td> <input type="hidden" name="insert"> </td>
    </tr>

  </table>
  <p class="submit">
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
  </p>
</form>

<?php
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
?>

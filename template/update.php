<?php
/**
 * update
 */


?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">
  <input type="submit" name="fetch" class="button button-primary" value="Fetch Data">
</form><br>

<?php if( isset($_POST['fetch']) ) :
  global $wpdb;
  $table_name = $wpdb->prefix . 'jomle';
  $jomle_rows = $wpdb->get_results( "SELECT * FROM $table_name" );

  ?>

  <table>
    <tr>
      <th>Title</th>
      <th>text</th>
      <th>Shortcode</th>
      <th>Edit</th>
    </tr>
    <?php
      if(null !== $jomle_rows){
        foreach($jomle_rows as $row) {
          echo '<form method="POST" action="'. htmlspecialchars($_SERVER["REQUEST_URI"]) .'">';
          echo "<tr>";
          echo '<td>'.'<input type="text" name="title" value="'. $row->title .'">'.'</td>';
          echo '<td>'.'<input type="text" name="text" value="'. $row->text .'">'.'</td>';
          echo '<td>'.'<input type="text" id="shortcode" name="shortcode" value="'. '[jomle id='. $row->id. ']' .'" readonly>'.'</td>';
          echo "<td>". '<input type="submit" name="submit" id="submit" class="button button-primary" value="Update">' .'</td>';
          echo '<input type="hidden" name="update">' ;
          echo '<input type="hidden" name="id" value="'. $row->id .'">';
          echo '</tr></form>' ;
        }
      }else {
        echo "0 results";
      }
    ?>

  </table>
<?php endif;

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

?>


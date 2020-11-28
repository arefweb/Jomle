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
    <input type="submit" name="submit" id="submit" onclick="" class="button button-primary" value="Save Changes">
  </p>
</form>

<?php
require __DIR__ . "/crud.php" ;
?>

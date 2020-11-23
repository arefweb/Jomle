<?php
/**
 * Created by PhpStorm.
 * User: d
 * Date: 11/19/2020
 * Time: 7:07 PM
 */

?>

<div class="wrap">
  <h1>Jomle Settings</h1>

  <div id="tablinks" class="nav-tab-wrapper">
    <a class="nav-tab-link" href="#tab-insert">Insert</a>
    <a class="nav-tab-link" href="#tab-update">Update</a>
    <a class="nav-tab-link" href="#tab-delete">Delete</a>
  </div>


    <div id="tab-insert" class="jomle-settings" id="tab-insert">
      <?php require __DIR__ . "/insert.php"; ?>
    </div>

    <div id="tab-update" class="jomle-settings" id="tab-update">
      <?php require __DIR__ . "/update.php"; ?>
    </div>

    <div id="tab-delete" class="jomle-settings" id="tab-delete">
      <?php require __DIR__ . "/delete.php"; ?>
    </div>

</div>


<!DOCTYPE html>
<html>
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial;
}

.header {
  text-align: center;
  padding: 32px;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  /* -ms-flex: 25%; /* IE10 */
  -ms-flex: 33.333%; /* IE10 */
  /*flex: 25%;*/
  flex: 33.333%;
  /*max-width: 25%;*/
  max-width: 33.333%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media all and (max-width: 768px) {
  .column {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media all and (max-width: 480px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}
</style>
<body>

<!-- Header -->
<div class="header">
  <h1>Responsive Image Grid</h1>
  <p>Resize the browser window to see the responsive effect.</p>
</div>

<!-- Photo Grid -->
<?php
    $dir_contents = scandir('images');

    // filter out everything except images
    $images = array_filter($dir_contents, function ($filename) {
      $file_extension = pathinfo('images/' . $filename, PATHINFO_EXTENSION);

      return in_array(strtolower($file_extension), ['jpeg', 'jpg', 'png', 'gif']);
    });

    $columns = [];

    // sort the images into roughly equal columns
    $current_column = 1;
    foreach ($images as $filename) {
      $current_column = $current_column > 3 ? 1 : $current_column;

      $columns[$current_column][] = $filename;

      $current_column++;
    }

?>

<div class="row">


<?php foreach ($columns as $column) : // display the columns ?>

  <div class="column">

    <?php foreach ($column as $filename) : ?>
      <img src="/images/<?= $filename ?>" style="width:100%">
    <?php endforeach; ?>

  </div>  <!-- .column -->

<?php endforeach; ?>

</div> <!-- .row -->

</body>
</html>

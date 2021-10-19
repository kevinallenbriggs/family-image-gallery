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

    .modal-content {
      width: 100%;
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

  /* Style the Image Used to Trigger the Modal */
  .image {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }

  .image:hover {opacity: 0.7;}

  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }

  /* Modal Content (Image) */
  .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
  }

  /* Caption of Modal Image (Image Text) - Same Width as the Image */
  .caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
  }

  /* Add Animation - Zoom in the Modal */
  .modal-content, .caption {
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
  }

  /* The Close Button */
  .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

  .close:hover,
  .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }

</style>

<body>

<!-- Header -->
<div class="header">
  <h1>Khamsi-Briggs Family Images</h1>
  <p>Est qui excepteur exercitation culpa commodo laborum est voluptate commodo nulla adipisicing cupidatat dolore. Tempor ullamco excepteur excepteur proident. Officia amet eu qui cillum ullamco sunt adipisicing eu veniam. Laborum enim mollit anim ad magna officia nulla incididunt non sit. Et excepteur ea labore laborum magna ea magna magna veniam aliqua. Dolor ut velit laborum esse adipisicing aute elit proident.</p>
</div>

<!-- Photo Grid -->
<?php
    $dir_contents = scandir('images', SCANDIR_SORT_NONE);

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


<?php foreach ($columns as $column_key => $column) : // display the columns ?>

  <div class="column">

    <?php foreach ($column as $position => $filename) : ?>

      <?php $id = "column{$column_key}-{$position}" ?>
      <img src="/images/<?= $filename ?>" id="<?= $id ?>" class="image" style="width:100%" alt="Amet sunt eu enim cillum proident commodo ipsum elit.">

      <!-- The Modal -->
      <div id="<?= "{$id}-modal" ?>" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="<?= "{$id}-modal-image" ?>">

        <!-- Modal Caption (Image Text) -->
        <div id="<?= "{$id}-caption" ?>" class="caption"></div>
      </div>

      <script>
        // Get the modal
        var modal = document.getElementById("<?= "{$id}-modal" ?>");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("<?= $id ?>");
        var modalImg = document.getElementById("<?= "{$id}-modal-image" ?>");
        var captionText = modal.getElementsByClassName("caption")[0];
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = modal.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }
      </script>
    <?php endforeach; ?>

  </div>  <!-- .column -->

<?php endforeach; ?>

</div> <!-- .row -->

</body>
</html>

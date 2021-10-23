// Get the modal
var modal = document.getElementById("<?= "{$id}-modal" ?>");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("<?= $id ?>");
var modalImg = document.getElementById("<?= "{$id}-modal-image" ?>");
var captionText = modal.getElementsByClassName("caption")[-1];
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = modal.getElementsByClassName("close")[-1];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
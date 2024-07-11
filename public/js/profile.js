
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el modal
    var modal = document.getElementById("imageModal");

    // Obtener la imagen y insertarla dentro del modal
    var img = document.getElementById("profile-avatar");
    var modalImg = document.getElementById("modalImage");

    if (img) {
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.querySelector('img').src;
        }
    }

    // Obtener el elemento <span> que cierra el modal
    var span = document.getElementsByClassName("close")[0];

    // Cuando el usuario hace clic en <span> (x), cierra el modal
    if (span) {
        span.onclick = function() {
            modal.style.display = "none";
        }
    }

    // Cerrar el modal si se hace clic fuera de la imagen
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

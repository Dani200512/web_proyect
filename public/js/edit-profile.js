document.addEventListener('DOMContentLoaded', function() {
    var profilePhotoInput = document.getElementById('profile-photo-input');
    var profileImage = document.getElementById('profile-image');
  
    profilePhotoInput.addEventListener('change', function(e) {
      var file = e.target.files[0];
      var reader = new FileReader();
      
      reader.onload = function(e) {
        profileImage.src = e.target.result;
      }
      
      reader.readAsDataURL(file);
    });
  });
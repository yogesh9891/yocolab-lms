function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#study_material_preview').attr('src', e.target.result);
    }
    $('.imgPreview').show();
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#study_material_preview_2').attr('src', e.target.result);
    }
    $('.imgPreview').show();
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


function isVideo(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'm4v':
    case 'avi':
    case 'mp4':
    case 'mov':
    case 'mpg':
    case 'mpeg':
        // etc
        return true;
    }
    return false;
}

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}


$("#study_material").change(function() {

	if (isVideo($(this).val())){
		$('.imgPreview').hide();
        $('.video-preview').attr('src', URL.createObjectURL(this.files[0]));
        $('.video-prev').show();
      }
      else
      {
      	$('.video-prev').hide();
		  readURL(this);
		}
});

$("#study_material_2").change(function() {

	if (isVideo($(this).val())){
		$('.imgPreview').hide();
        $('.video-preview').attr('src', URL.createObjectURL(this.files[0]));
        $('.video-prev').show();
      }
      else
      {
      	$('.video-prev').hide();
		  readURL(this);
		}
});

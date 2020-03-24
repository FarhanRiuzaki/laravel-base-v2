// ADMINART
// apps
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: 'true',
    orientation: 'bottom',
    todayHighlight: 'true'
});

// fill 15 char untuk no rek
function pad (str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}

// validasi file upload
function fileCheck(file,size, file_type = []) {
  
  file_name   = file.files[0].name;
  size        = file.files[0].size / 1024;
  limit       = 1024 * size;
  validExtensions = file_type;

  extension   = file_name.substr( (file_name.lastIndexOf('.') + 1) );
  
  // change_name = file_name.split('.').shift() + '' + parseInt(Math.random() * 10000) + '.' + extension;
  
  // file.name = change_name;

  valid = true;
  if(validExtensions.indexOf(extension) == -1){
      swal.fire('Oops', 'file harus berektensi: ' + file_type, 'info');
      file.value = '';
  }

  if(size > limit){
      swal.fire('Oops', 'file harus berukuran kurang dari 1MB', 'info');
      file.value = '';
  }

}

// deklarasi function
window.pad        = pad;
window.fileCheck  = fileCheck;

// COMPONENT
$('.number').number(true, 2);
// $('.numberOnly').number(true);
$(".numberOnly").on("keypress keyup blur",function (event) {    
  $(this).val($(this).val().replace(/[^\d].+/, ""));
   if ((event.which < 48 || event.which > 57)) {
       event.preventDefault();
   }
});

$('#detailList').on('shown.bs.collapse', function() {
    $(".iconDrop").addClass('fa-angle-up').removeClass('fa-angle-down');
  });

$('#detailList').on('hidden.bs.collapse', function() {
    $(".iconDrop").addClass('fa-angle-down').removeClass('fa-angle-up');
  });

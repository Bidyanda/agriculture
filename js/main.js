function toast(msg, c) {
    var x = $("#snackbar");
    x.addClass("show "+c);
    x.html(msg);
    setTimeout(function() {
        x.removeClass("show "+c);
    }, 4000);
}

// for modal
$(document).on('click', '.openModal', function() {
    var size = $(this).attr('size');
    var url = $(this).attr('href');
    var header = $(this).attr("header");
    header = header ? header : '';
    $('#modal-'+size).find(".header-text").text(header);
    $('#modal-'+size+'-loader').show();
    $('#modal-'+size).modal('show').find('#modal-'+size+'-body')
    .html("").load(url, function() {
        $('#modal-'+size+'-loader').hide();
    });
    return false;
});

// doesn't work if input type="number" is specified
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

// doesn't work if input type="number" is specified
$(".numberonly").inputFilter(function(value) {
    return /^\d*$/.test(value);
});
// doesn't work if input type="number" is specified
$(".percentage").inputFilter(function(value) {
    return /^[1-9]?[0-9]?\.?\d?\d?$|^100/.test(value);
});

function readURL(input, elem) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      elem.attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function() {
    $("#full-loader").fadeOut();
});

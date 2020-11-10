$(document).ready(function() {


	$('#sendQ').click( function() {
		$("#loader").css("display", "flex");
		// $('#TableData').load('Engine/query.php?keyQuery=' + encodeURIComponent($('#myInput').val()));
		$.get('Engine/query.php?keyQuery=' + encodeURIComponent($('#myInput').val() ), function(data) {
			$('#TableData').html(data);
			$('#loader').hide();
			
		});
	});


	// $(".context").markRanges(ranges [, options]);

});

$(function() {

  var mark = function() {

    // Read the keyword
    // var keyword = $("input[name='keyword']").val();
    var keyword = $("#myInput']").val();

    // Determine selected options
    // var options = {};
    // $("input[name='opt[]']").each(function() {
    //   options[$(this).val()] = $(this).is(":checked");
    // });

    // Remove previous marked elements and mark
    // the new keyword inside the context
    $(".context").unmark({
      done: function() {
        $(".context").mark(keyword);
      }
    });
  };

  $("#myInput").on("input", mark);

});

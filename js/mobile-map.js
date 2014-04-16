jQuery(function($){
	$('#map-generator').on('click', function () {
		//$('#sample-area p').css('display', 'none');
		$('#sample-area p').css('visible', 'hidden');
		var sample_width = $('#sample-width').attr('value');
		var sample_ratio = $('#sample-ratio').attr('value');
		console.log((50 / sample_ratio) + '%');
		$('#mobile-map').smoothZoom({
			width: 480,
			height: 320,
			
			/******************************************
			Enable Responsive settings below if needed.
			Max width and height values are optional.
			******************************************/
			responsive: true,
			responsive_maintain_ratio: true,
			max_WIDTH: '',
			max_HEIGHT: ''
		});
	
	});
	
	$('#map-status-generator').on('click', function () {		
		var zoomDataObject = $('#mobile-map').smoothZoom('getZoomData');		
		$('#map-status-data').html(		
			"Original Center Position Offset X: <span style='color:#000000'>"+parseInt(zoomDataObject.normX) +"</span>"
			+"<br />Original Center Position Offset Y: <span style='color:#000000'>"+parseInt(zoomDataObject.normY) +"</span>"
			+"<br />Original Image Width: <span style='color:#000000'>"+parseInt(zoomDataObject.normWidth) +"</span>"
			+"<br />Original Image Height: <span style='color:#000000'>"+parseInt(zoomDataObject.normHeight) +"</span>"
			
			+"<br /><br />Scaled Center Position Offset X: <span style='color:#000000'>"+parseInt(zoomDataObject.scaledX)  +"</span>"
			+"<br />Scaled Center Position Offset Y: <span style='color:#000000'>"+parseInt(zoomDataObject.scaledY) +"</span>"
			+"<br />Scaled Image Width: <span style='color:#000000'>"+parseInt(zoomDataObject.scaledWidth) +"</span>"
			+"<br />Scaled Image Height: <span style='color:#000000'>"+parseInt(zoomDataObject.scaledHeight) +"</span>"

			+"<br /><br />Current Center Position X (relate to the top left corner of the original image): <span style='color:#000000'>"+parseInt(zoomDataObject.centerX) +"</span>"
			+"<br />Current Center Position Y (relate to the top left corner of the original image): <span style='color:#000000'>"+parseInt(zoomDataObject.centerY) +"</span>"	
			
			+"<br /><br />Scale Ratio: <span style='color:#000000'>"+zoomDataObject.ratio +"</span>"	
		);	
	});
});

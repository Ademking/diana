var chobi = null;
var pictureContainer = null;
function initializeCamera(){
	pictureContainer = document.getElementById('webcam-picture-container');
	Webcam.set({
			width: 320,
			height: 240,
			dest_width: 640,
			dest_height: 480,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( 'webcam-picture-container' );
}

function resetCamera(){
	Webcam.reset();
}


function takePicture(){
	Webcam.snap( function(data_uri) {
				var img = new Image();
				img.src = data_uri;
				chobi = new Chobi(img);
				chobi.canvas=document.getElementById('saved-image-container');
				chobi.loadImageToCanvas();
				document.getElementById('saved-image-container').style.display = "block";
			} );
}

function hidePicture(){
	document.getElementById('saved-image-container').style.display = "none";
}

function savePicture(){
	chobi.download("diana's image","jpeg");
}

function showPreview(){
	pictureContainer.style.display = "block";
}
function hidePreview(){
	pictureContainer.style.display = "none";
}

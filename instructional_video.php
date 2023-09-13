<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CRoboto:400,700" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
/* Optional styles */
/* video {
  object-fit: revert;
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
} */

html, body {
  width: auto;
  height: auto;
  background-color: #22B8D1;
}
html {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
 
}
body {
  margin: 0;
}

.viewport-header {
  position: relative;
  height: 50vh;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
}

h1 {
  font-family: 'Syncopate', sans-serif;
  color: #4a3a27;
  text-transform: uppercase;
  font-size: 18px;
  text-align: center;

}

main {
  top: 50%;
  text-align: center;
  width: 80vw;
  left: 10%;
  height: 40vh;
  overflow: auto;
  background: rgba(black, 0.66);
  color: #22B8D1;
  position: fixed;
  padding: 1rem;
}
@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  main {
  top: 70%;
  text-align: center;
  width: 80vw;
  left: 10%;
  height: 40vh;
  overflow: auto;
  background: rgba(black, 0.66);
  color: white;
  position: fixed;
  padding: 1rem;
}
 .video-container {
	 width: 100% !important;
	 
}
}
/* END Optional styles */
 .video-container {
	 width: 840px;
	 border-radius: 4px;
	 margin: 0 auto;
	 position: relative;
	 display: flex;
	 flex-direction: column;
	 justify-content: center;
	 box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4);
}
 .video-container .video-wrapper {
	 width: 100%;
	 height: 100%;
	 display: flex;
	 justify-content: center;
	 align-items: center;
}
 .video-container video {
	 width: 100%;
	 height: 100%;
	 border-radius: 4px;
}
 .play-button-wrapper {
	 position: absolute;
	 top: 0;
	 left: 0;
	 right: 0;
	 bottom: 0;
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 width: 100%;
	 height: auto;
	 pointer-events: none;
}
 .play-button-wrapper #circle-play-b {
	 cursor: pointer;
	 pointer-events: auto;
}
 .play-button-wrapper #circle-play-b svg {
	 width: 100px;
	 height: 100px;
	 fill: #fff;
	 stroke: #fff;
	 cursor: pointer;
	 background-color: rgba(0, 0, 0, 0.2);
	 border-radius: 50%;
	 opacity: 0.9;
}
 
</style>
</head>
<body>
  
  <div class="video-wrapper" style="margin-top:5%;">
    <div class="video-container" id="video-container">
      <video controls id="video" preload="metadata" >
        <source src="School video 4_2.mp4" type="video/mp4">
      </video>
  
      <div class="play-button-wrapper">
        <div title="Play video" class="play-gif" id="circle-play-b">
          <!-- SVG Play Button -->
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
            <path d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z" />
          </svg>
        </div>
      </div>
    </div>
  </div>
  



  
</body>
<script>
  const video = document.getElementById("video");
const circlePlayButton = document.getElementById("circle-play-b");
video.volume = 0.2;

function togglePlay() {
	if (video.paused || video.ended) {
		video.play();
	} else {
		video.pause();
	}
}

circlePlayButton.addEventListener("click", togglePlay);
video.addEventListener("playing", function () {
	circlePlayButton.style.opacity = 0;
});
video.addEventListener("pause", function () {
	circlePlayButton.style.opacity = 1;
});

</script>
</html>

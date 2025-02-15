<head>
  <style>
    body .slider_container{
      accent-color: #6BB2D1;
    }
  </style>
</head>
<div class=" z-3 row position-fixed bottom-0 ms-2" style="width: 100%;">
    <div class="row lh-1 music-player">
      <div id="musicplayer" class="border border-1" style="display: none;">
        <div class="details">
          <div class="now-playing" hidden>PLAYING x OF y</div>
          <div class="row">
            <div class="col-1 pt-1">
              <img class="track-art" src="img/avatar_phuong.jpg" alt="" style="height: 3em; width: 3em;">
            </div>
            <div class="col-3 pt-2">
              <div class="row track-name fw-bold fs-4 pb-1"></div>
              <div class="row track-artist"></div>
            </div>
            <div class="col-4 align-self-center ">
              <div class="row pt-1">
                <div class="col prev-track"><i onclick="prevTrack()" class="fa fa-step-backward fa-2x"></i></div>
                <div class="col playpause-track" onclick="playpauseTrack()"><i class="fa fa-play-circle fa-2x"></i></div>
                <div class="col next-track"><i onclick="nextTrack()" class="fa fa-step-forward fa-2x"></i></div>
              </div>
            </div>
            <div class="col-4 slider_container align-self-center">
              <div class='d-flex justify-content-end'>
                <i class="fa-solid fa-volume-high me-3"></i>
                <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">

              </div>

            </div>
          </div>


        </div>

        <div class="row slider_container">
          <div class="row">
            <p class="col d-flex justify-content-start current-time m-0">00:00</p>
            <p class="col d-flex justify-content-end total-duration m-0">00:00</p>
          </div>
          <div class="row">
            <input type="range" min="1" max="100" value="0" class="seek_slider p-0 input-group input-group-sm" onchange="seekTo()">
            <div class='col-1'></div>
          </div>


        </div>

      </div>
    </div>
  </div>
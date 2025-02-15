<?php
  $result = mysqli_query($conn, $sql);
  foreach ($result as $data) {
    $IdBH[] = $data['IdBaiHat'];
    $TenNS[] = $data['TenNgheSi'];
    $Audio[] = $data['Audio'];
    $Hinh[] = $data['HinhBaiHat'];
    $TenBH[] = $data['TenBaiHat'];
  }
  ?>
  <script>
    function random_bg_color() {
      // Get a number between 64 to 256 (for getting lighter colors)
      let red = Math.floor(Math.random() * 256) + 64;
      let green = Math.floor(Math.random() * 256) + 64;
      let blue = Math.floor(Math.random() * 256) + 64;

      // Construct a color withe the given values
      let bgColor = "rgb(" + red + "," + green + "," + blue + "," + 0.2 + ")";
      let bg = document.getElementById("musicplayer");
      // Set the background to that color
      bg.style.background = bgColor;
    }

    let idsong = <?php echo json_encode($IdBH) ?>;
    let name = <?php echo json_encode($TenBH) ?>;
    let artist = <?php echo json_encode($TenNS) ?>;
    let image = <?php echo json_encode($Hinh) ?>;
    let path = <?php echo json_encode($Audio) ?>;


    let now_playing = document.querySelector(".now-playing");
    let track_art = document.querySelector(".track-art");
    let track_name = document.querySelector(".track-name");
    let track_artist = document.querySelector(".track-artist");

    let playpause_btn = document.querySelector(".playpause-track");
    let next_btn = document.querySelector(".next-track");
    let prev_btn = document.querySelector(".prev-track");

    let seek_slider = document.querySelector(".seek_slider");
    let volume_slider = document.querySelector(".volume_slider");
    let curr_time = document.querySelector(".current-time");
    let total_duration = document.querySelector(".total-duration");

    let curr_track = document.createElement('audio');
    let isPlaying = false;
    let updateTimer;

    function loadTrack(track_index) {
      clearInterval(updateTimer);
      resetValues();
      curr_track.src = "music_LTW/" + path[track_index];
      curr_track.load();

      track_art.src = image[track_index];
      track_name.textContent = name[track_index];
      track_artist.textContent = artist[track_index];
      now_playing.textContent = "PLAYING " + (track_index + 1) + " OF " + path.length;

      updateTimer = setInterval(seekUpdate, 1000);
      curr_track.addEventListener("ended", nextTrack);
      random_bg_color();
    }

    function resetValues() {
      curr_time.textContent = "00:00";
      total_duration.textContent = "00:00";
      seek_slider.value = 0;
    }

    function playpauseTrack() {
      if (!isPlaying) playTrack();
      else pauseTrack();
    }

    function playTrack() {
      curr_track.play();
      isPlaying = true;
      playpause_btn.innerHTML = '<i class="fa fa-pause-circle fa-2x"></i>';
    }

    function pauseTrack() {
      curr_track.pause();
      isPlaying = false;
      playpause_btn.innerHTML = '<i class="fa fa-play-circle fa-2x"></i>';;
    }

    function nextTrack() {
      if (track_index < name.length - 1)
        track_index += 1;
      else track_index = 0;
      loadTrack(track_index);
      playTrack();
    }

    function prevTrack() {
      if (track_index > 0)
        track_index -= 1;
      else track_index = name.length;
      loadTrack(track_index);
      playTrack();
    }

    function seekTo() {
      let seekto = curr_track.duration * (seek_slider.value / 100);
      curr_track.currentTime = seekto;
    }

    function setVolume() {
      curr_track.volume = volume_slider.value / 100;
    }

    function seekUpdate() {
      let seekPosition = 0;

      if (!isNaN(curr_track.duration)) {
        seekPosition = curr_track.currentTime * (100 / curr_track.duration);

        seek_slider.value = seekPosition;

        let currentMinutes = Math.floor(curr_track.currentTime / 60);
        let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
        let durationMinutes = Math.floor(curr_track.duration / 60);
        let durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);

        if (currentSeconds < 10) {
          currentSeconds = "0" + currentSeconds;
        }
        if (durationSeconds < 10) {
          durationSeconds = "0" + durationSeconds;
        }
        if (currentMinutes < 10) {
          currentMinutes = "0" + currentMinutes;
        }
        if (durationMinutes < 10) {
          durationMinutes = "0" + durationMinutes;
        }

        curr_time.textContent = currentMinutes + ":" + currentSeconds;
        total_duration.textContent = durationMinutes + ":" + durationSeconds;
      }
    }

    let track_index = 0;

    function getInfo(x) {

      var hid = document.getElementById("musicplayer");
      if (hid.style.display === "none") {
        hid.style.display = "block";
      }
      Player(x);
    }

    function Player(a) {
      let idcurr = a;

      let vt = 0;
      while (idsong[vt] != idcurr) {
        vt++;
      }

      track_index = vt;

      loadTrack(track_index);
      playTrack();
    }
  </script>
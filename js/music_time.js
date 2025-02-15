function toTime(seconds) {
    var minutes = Math.floor(seconds / 60);
    var seconds = Math.floor(seconds % 60);
    return minutes + ':' + (seconds < 10 ? '0' + seconds : seconds);
  }

  function GetTimeMs(idAudio, x) {
    var duration = idAudio.duration;
    var time = toTime(duration);
    var idspan = 'timems_' + x;
    document.getElementById(idspan).innerHTML = time;
  }
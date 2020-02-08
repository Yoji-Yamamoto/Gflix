function VolumeToggle(button){
    var muted = $(".previewVideo").prop("muted");
    $("previewVideo").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-volume-mute");
    $(button).find("i").toggleClass("fa-volume-up");
}

function previewEnd(){
    $(".previewVideo").toggle();
    $(".previewImage").toggle();
}

function goBack(){
    window.history.back();
}

function startTimer(){
    var timeout = null;

    $(document).on("mouseover", function(){
        clearTimeout(timeout);
        $(".watchNav").fadeIn();
        
        timeout = setTimeout(function(){
            $(".watchNav").fadeOut();
        }, 2000);
    });
}

function initVideo(videoId, username){
    startTimer();
    updateProgressTimer(videoId, username)
}

function updateProgressTimer(videoId, username){
    addDuration(videoId, username);

    var timer;

    $("video").on("playing", function(event){
        window.clearInterval(timer);
        timer = window.setInterval(function(){
            updateProgress(videoId, username, event.target.currentTime)
        }, 3000);
    })

    .on("ended", function(){
      window.clearInterval(timer);      
    })
}

function addDuration(videoId, username) {
    $.post("ajax/addDuration.php", {videoId: videoId, username:username},
     function(data){
         if(data !== null && data !== ""){
            alert(data);
         } 
    })
}

function updateProgress(videoId, username, progress){
    $.post("ajax/updateDuration.php", {videoId: videoId, username:username, progress: progress},
    function(data){
        if(data !== null && data !== ""){
           alert(data);
        } 
   })

}
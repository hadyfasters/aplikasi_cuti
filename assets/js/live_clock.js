setInterval(function() {
    var currentTime = new Date();
    var currentDate = currentTime.getDate();
    var currentMonth = currentTime.getMonth()+1;
    var currentYear = currentTime.getFullYear();
    var today = currentDate+"-"+currentMonth+"-"+currentYear;
    var currentHours = currentTime.getHours();   
    var currentMinutes = currentTime.getMinutes();   
    var currentSeconds = currentTime.getSeconds(); 
    currentHours = ( currentHours < 10 ? "0" : "" ) + currentHours;
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;  
    $('#timer').html(
    	today + " " + currentHours + ":" + currentMinutes + ":" + currentSeconds
    );
}, 1000);
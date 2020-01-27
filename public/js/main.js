$(document).ready(function(){
    const time = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"});
    const currentTime = new Date(time);
    var chosenStartTime = 0;
    var chosenStartDate = 0;
    var chosenEndDate = 0;

    $('#id_start').datetimepicker({
        format: 'Y-m-d H:i',
        minDate: currentTime,
        onSelectDate: function(date){
          chosenStartDate = date.getDate();
        },
        onSelectTime: function (time) {
            chosenStartTime = time.getHours();
            if(chosenStartDate == currentTime.getDate() && time.getHours() <= currentTime.getHours()){
                $('#submit').attr("disabled",true);
                $('#update').attr("disabled",true);
            }
            else {
                $('#submit').attr("disabled",false);
                $('#update').attr("disabled",false);
            }
        }
    });

    $('#id_end').datetimepicker({
        format: 'Y-m-d H:i',
        minDate: currentTime,
        onSelectDate: function(date){
            chosenEndDate = date.getDate();
            if(chosenEndDate < chosenStartDate){
                $('#submit').attr("disabled",true);
                $('#update').attr("disabled",true);
            }
            else {
                $('#submit').attr("disabled",false);
                $('#update').attr("disabled",false);
            }
        },
        onSelectTime: function (time) {
            if(chosenEndDate == chosenStartDate && time.getHours() <= chosenStartTime || chosenEndDate < chosenStartDate){
                $('#submit').attr("disabled",true);
                $('#update').attr("disabled",true);
            }
            else {
                $('#submit').attr("disabled",false);
                $('#update').attr("disabled",false);
            }
        }
    });

    $('#id_ticket_end_date').datetimepicker({
        format: 'Y-m-d H:i',
        minDate: currentTime,
        onSelectDate: function(date){
          chosenStartDate = date.getDate();
        },
        onSelectTime: function (time) {
            chosenStartTime = time.getHours();
            if(chosenStartDate == currentTime.getDate() && time.getHours() <= currentTime.getHours()){
                $('#submit').attr("disabled",true);
                $('#update').attr("disabled",true);
            }
            else {
                $('#submit').attr("disabled",false);
                $('#update').attr("disabled",false);
            }
        }
    });

    $('#id_event_date').datetimepicker({
        format: 'Y-m-d',
        minDate: currentTime,
        onSelectDate: function(date){
          chosenStartDate = date.getDate();
        }
    });

});
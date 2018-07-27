

function ajax($id){
    //get the input value
    $.ajax({
        //the url to send the data to
        url: "php/send.php",
        data: 'mrid='+$id,
dataType:'html',

        //type. for eg: GET, POST
        type: "POST",
        //on success
        success: function(data){
            console.log("***********Success***************");
            console.log(data);
        },
        //on error
        error: function(){
            console.log("***********Error***************");
            console.log(data);
        }
    });
}


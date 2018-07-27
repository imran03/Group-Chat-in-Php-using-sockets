$(function(){
    $('#privateChat').on('submit', function(){
        var type = $('#privateChat').attr('type');
         if(type == 'pchat'){
            // var usrName = sessionStorage.getItem('fullname', fullname)
            var message = $('#message').val();
            var name = $('#submit').attr('userName');
            if(message.length > 0){
                $.ajax({
                    type: 'POST',
                    url: 'php/send.php',
                    data: 'pname='+name+'&pmessage='+message,
                    dataType: 'HTML',
                    success: function(data){
                        send(data);
                        console.log(data);
                        $('#message').val('').focus();
                    }

                });
            }else{
                alert('Type your private message...');
                $('#name').focus();
            }
            return false;
        }
    });
});


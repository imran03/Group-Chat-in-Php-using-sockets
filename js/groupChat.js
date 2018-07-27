$(function(){
	$('#formChat').on('submit', function(){
		var type = $('#formChat').attr('type');
		if(type == 'chat'){
			// var usrName = sessionStorage.getItem('fullname', fullname)
			var message = $('#message').val();
			var name = $('#submit').attr('userName');
			if(message.length > 0){
				$.ajax({
					type: 'POST',
					url: 'php/send.php',
					data: 'name='+name+'&message='+message,
					dataType: 'HTML',
					success: function(data){
						send(data);
						console.log(data);
						$('#message').val('').focus();
					}

				});
			}else{
				alert('Type your message.');
				$('#name').focus();
			}
			return false;
		}
	});
});


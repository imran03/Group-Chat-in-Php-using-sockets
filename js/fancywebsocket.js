var Server;

$(document).ready(function(){
	Server = new FancyWebSocket('ws://'+urlPort);
    Server.bind('open', function()
	{
    });
    Server.bind('close', function( data ) 
	{
    });
    Server.bind('message', function( payload ) 
	{
    });
    Server.connect();
});

function send(text){
    Server.send('message', text);
}

var FancyWebSocket = function(url){
	var callbacks = {};
	var ws_url = url;
	var conn;
	
	this.bind = function(event_name, callback){
		callbacks[event_name] = callbacks[event_name] || [];
		callbacks[event_name].push(callback);
		return this;
	};
	
	this.send = function(event_name, event_data){
		this.conn.send( event_data );
		return this;
	};
	
	this.connect = function() {
		if ( typeof(MozWebSocket) == 'function' )
		this.conn = new MozWebSocket(url);
		else
		this.conn = new WebSocket(url);
		
		this.conn.onmessage = function(evt)
		{
			dispatch('message', evt.data);
		};
		
		this.conn.onclose = function(){dispatch('close',null)}
		this.conn.onopen = function(){dispatch('open',null)}
	};
	
	this.disconnect = function(){
		this.conn.close();
	};
	
	var dispatch = function(event_name, message){
		if(message != null && message != ""){
			var data = JSON.parse(message);
			var nameData = data.name;
			var messageData = data.message;
			var sesionData = data.sesion;
			var dateTime = data.dateTime;
			var sesionBody = $('#submit').attr('fullname');
			var sname=document.getElementById("userName").innerText;
			//alert (sname);
			if(sname == nameData){
				$('#containerMessages').append('<li class="meMessage"><label>'+nameData+': </label>'+messageData+' '+dateTime+'</li>');
			}else{
				$('#containerMessages').append('<li class="yourMessage"><label>'+nameData+': </label>'+messageData+' '+dateTime+'</li>');
			}
			var height = $('body').prop('scrollHeight');
			$('html, body').animate({scrollTop: height}, 600);
		}
		
	}
};




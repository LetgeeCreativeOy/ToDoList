function CheckLenght() {
	
	var charsLeft = 256 - $("#newTwoot").val().length;
	$("#charsLeft").html( "&emsp;" + (charsLeft) );
	
	if( $("#newTwoot").val().length > 256 )
	{
		$("#newTwoot").val( $("#newTwoot").val().substring( 0, 256 ) );
	}
	
	setTimeout( function(){ CheckLenght() }, 30 );
}

function PostTwoot() {
    var text = $("#newTwoot").val();
	
	if( text.length > 0 && text.match(/^\s+$/) === null )
	{
		$("#newTwoot").val("");
		//text = text.replace(/\n/g, "");
		
		$.ajax ({
			type: "POST",
			url: "data.php",
			data: {type: "sentTwoot", msg: text}
		}).done(function( data ){
			if( data.length > 0 ) alert( data ); }
		);
		
		Refresh();
	}
}

function GetTwoots() {    
	Refresh();
    setTimeout( function(){ GetTwoots() }, 15000 );
}

function Refresh() {
	$.ajax ({
        type: "POST",
        url: "data.php",
        data: {type: "getTwoots"}
    }).done(function( data ){
		$("#twoots").html( data );
    });
}

function BanUser( id ) {
	if( confirm( "Are you sure you want to ban this user?" ) )
	{
		 $.ajax ({
			type: "POST",
			url: "data.php",
			data: {type: "ban", userid: id}
		}).done(function( data ){
			alert( "User is bannded" );
		});
		
		Refresh();
	}
}

function Like( twoot_id ) {
	$.ajax ({
		type: "POST",
		url: "data.php",
		data: {type: "like", twootid: twoot_id}
	}).done(function( data ){
		Refresh();
	});
}
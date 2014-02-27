<div>
	<script src="http://connect.soundcloud.com/sdk.js"></script>
	<script>
	SC.initialize({
	  client_id: 'YOUR_CLIENT_ID'
	});

	var track_url = '{{$p["soundcloud_url"]}}';
	SC.oEmbed(track_url, { auto_play: true }, function(oEmbed) {
	  console.log('oEmbed response: ' + oEmbed);
	});
	</script>
	
</div>
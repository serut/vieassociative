// Display Latest Tweet

$(document).ready(function(){

$.getJSON('twitter-sample.txt', function(data){
        $.each(data, function(index, item){
                $('#tweet').append('<div><p>' + item.text.linkify() + '</p></div>'+ '<div id="web_intent">' + '<span class="time">' + relative_time(item.created_at) + '</span>' + '<a title="Retweet" href="http://twitter.com/intent/retweet?tweet_id=' + item.id_str + '"><img src="/img/retweet_mini.png" width="16" height="16" alt="Retweet"></a> <a title="Repondre" href="http://twitter.com/intent/tweet?in_reply_to=' + item.id_str + '"><img src="/img/reply_mini.png" width="16" height="16" alt="Repondre"></a>' + '<a title="Favoris" href="http://twitter.com/intent/favorite?tweet_id=' + item.id_str + '">' + '<img src="/img/favorite_mini.png" width="16" height="16" alt="Favoris"></a>' + '</div>');
		});
});


// Convert Twitter API Timestamp to "Time Ago"

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  var r = '';
  if (delta < 60) {
        r = '1 m';
  } else if(delta < (45*60)) {
        r = (parseInt(delta / 60)).toString() + ' minutes';
  } else if(delta < (90*60)) {
        r = '1 h';
  } else if(delta < (24*60*60)) {
        r = 'il y  a ' + (parseInt(delta / 3600)).toString() + ' heures';
  } else if(delta < (48*60*60)) {
        r = '1 j';
  } else {
        r = 'il y  a ' + (parseInt(delta / 86400)).toString() + ' jours';
  }

  	  return r;
	}

});	


// Create Usable Links

String.prototype.linkify = function() {
       return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(m) {
              return m.link(m);
      });
};
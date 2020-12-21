 function subscribe() {
    // OneSignal.push(["registerForPushNotifications"]);
    OneSignal.push(["registerForPushNotifications"]);
    event.preventDefault();
}
function unsubscribe(){
    OneSignal.setSubscription(true);
}

(function($) {
	"use strict";

	var OneSignal = OneSignal || [];

	OneSignal.push(function() {
	    / These examples are all valid /
	    // Occurs when the user's subscription changes to a new value.
	    OneSignal.on('subscriptionChange', function (isSubscribed) {
	        console.log("The user's subscription state is now:", isSubscribed);
	        OneSignal.sendTag("user_id","4444", function(tagsSent)
	        {
	            // Callback called when tags have finished sending
	            console.log("Tags have finished sending!");
	        });
	    });

	    var isPushSupported = OneSignal.isPushNotificationsSupported();
	    if (isPushSupported)
	    {
	        // Push notifications are supported
	        OneSignal.isPushNotificationsEnabled().then(function(isEnabled)
	        {
	            if (isEnabled)
	            {
	                console.log("Push notifications are enabled!");

	            } else {
	                OneSignal.showHttpPrompt();
	                console.log("Push notifications are not enabled yet.");
	            }
	        });
	    }
	    else {
	        console.log("Push notifications are not supported.");
	    }
	});

})(jQuery);
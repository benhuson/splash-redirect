
var SplashRedirect = {

	// Init
	init : function() {
		if (SplashRedirectVars.current_page == "redirect") {
			if (!SplashRedirect.has_seen_splash()) {
				document.location = SplashRedirectVars.splash_page_url;
			}
		} else if (SplashRedirectVars.current_page == "splash") {
			document.cookie = "splash_redirect=;path=/;";
		}
	},

	// Has Seen Splash
	has_seen_splash : function() {
		if (SplashRedirect.cookies_enabled()) {
			if (document.cookie.indexOf("splash_redirect") != -1) {
				return true;
			}
			return false;
		}
		return true;
	},

	// Reset
	reset : function() {
		document.cookie = 'splash_redirect=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	},

	// Cookies Enabled
	cookies_enabled : function() {
		var cookieEnabled = (navigator.cookieEnabled) ? true : false;
		if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled) { 
			document.cookie = "splash_redirect_test";
			cookieEnabled = (document.cookie.indexOf("splash_redirect_test") != -1) ? true : false;
		}
		return (cookieEnabled);
	}

};

SplashRedirect.init();

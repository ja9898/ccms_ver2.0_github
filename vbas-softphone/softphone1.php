<?php
	
	/*
	//MySQL Database Credentials.
	$hostname_conn = "203.124.41.85";
	$database_conn = "taleemeq_taleem";
	$username_conn = "shahidtq";
	$password_conn = "QQP336F4739DAmpJ"; 
	$conn = mysql_connect($hostname_conn,$username_conn,$password_conn);
	mysql_select_db($database_conn,$conn);
	
	//Fetching the User details from database.
	$sql_user  = "SELECT * FROM tbl_user WHERE id = '".$_GET['user_id']."'" ; 
	$exe_query = mysql_query($sql_user) or die(mysql_error());
	$isrs 	   = mysql_num_rows($exe_query); // Is record exsist.
	if($isrs > 0 ){
	$fetch_record = mysql_fetch_array($exe_query);	
		$fullname		= $fetch_record['firstName']." ".$fetch_record['lastName'] ; 
		$sip		= $fetch_record['sip_server'] ;
		$username	= $fetch_record['username'] ;
		$password 	= $fetch_record['password'] ;
	}
	*/
	$sip		= "sip:8001@115.186.163.171";
	$username	= "8001";
	$password   = "test786";
	$fullname   = "Shahid Umar";
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"> 
    <head>
		<title>..:: VBAS Dialer ::..</title>
		<link href="style/style.css" rel="stylesheet" type="text/css" />
        <meta name="google" value="notranslate" />         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Include CSS to eliminate any default margins/padding and set the height of the html element and 
             the body element to 100%, because Firefox, or any Gecko based browser, interprets percentage as 
             the percentage of the height of its parent container, which has to be set explicitly.  Fix for
             Firefox 3.6 focus border issues.  Initially, don't display flashContent div so it won't show 
             if JavaScript disabled.
        -->
        <style type="text/css" media="screen"> 
            html, body  { height:100%; }
            body { margin:0; padding:0; overflow:auto; text-align:center; 
                   background-color: #ffffff; }   
            object:focus { outline:none; }
            #flashContent { display:none; }
        </style>
        
        <!-- Enable Browser History by replacing useBrowserHistory tokens with two hyphens -->
        <!-- BEGIN Browser History required section -->
        <link rel="stylesheet" type="text/css" href="history/history.css" />
        <script type="text/javascript" src="history/history.js"></script>
        <!-- END Browser History required section -->  
            
        <script type="text/javascript" src="swfobject.js"></script>
        <script type="text/javascript">
            // For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. 
            var swfVersionStr = "11.1.0";
            // To use express install, set to playerProductInstall.swf, otherwise the empty string. 
            var xiSwfUrlStr = "playerProductInstall.swf";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "Softphone";
            attributes.name = "Softphone";
            attributes.align = "middle";
            swfobject.embedSWF(
                "Softphone.swf", "flashContent", 
                "330", "554", 
                swfVersionStr, xiSwfUrlStr, 
                flashvars, params, attributes);
            // JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
            swfobject.createCSS("#flashContent", "display:block;text-align:left;");
        </script>
    </head>
    <body>
        <!-- SWFObject's dynamic embed method replaces this alternative HTML content with Flash content when enough 
             JavaScript and Flash plug-in support is available. The div is initially hidden so that it doesn't show
             when JavaScript is disabled.
        -->
		<div id="maincontainer">
		<div id="topsection">
			<div class="innertube" >
				<center>
					<img src="img/logo.png"  />
				</center>
			</div>
		</div>
		<center>
        <div id="flashContent">
            <p>
                To view this page ensure that Adobe Flash Player version 
                11.1.0 or greater is installed. 
            </p>
            <script type="text/javascript"> 
                var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://"); 
                document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" 
                                + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" ); 
            </script> 
        </div>
        
        <noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="330" height="554" id="Softphone">
                <param name="movie" value="Softphone.swf" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="allowFullScreen" value="true" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="Softphone.swf" width="330" height="554">
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="#ffffff" />
                    <param name="allowScriptAccess" value="sameDomain" />
                    <param name="allowFullScreen" value="true" />
                <!--<![endif]-->
                <!--[if gte IE 6]>-->
                    <p> 
                        Either scripts and active content are not permitted to run or Adobe Flash Player version
                        11.1.0 or greater is not installed.
                    </p>
                <!--<![endif]-->
                    <a href="http://www.adobe.com/go/getflashplayer">
                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" />
                    </a>
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
        </noscript>     
	
	<!-- Audios -->
	<audio id="audio_remote" autoplay="autoplay" volume="0.6"/>
	
	</center>
	<div id="footer"><a href="#">Copyrights</a></div>
	</div>
   </body>
	<script src="SIPml-api.js" type="text/javascript"> </script>
	<script language="javascript" type="application/javascript">
		var fullname = '<?php echo $fullname ; ?>';
		var sip		 = '<?php echo $sip ;  ?>';	
		var username = '<?php echo $username ;?>';	
		var password = '<?php echo $password ;  ?>';	
		var releam 	 = "biralsabia" 

		var sTransferNumber;
		var oRingTone, oRingbackTone;
		var oSipStack, oSipSessionRegister, oSipSessionCall, oSipSessionTransferCall;
		var videoRemote, videoLocal, audioRemote;
		var bFullScreen = false;
		var oNotifICall;
		var oReadyStateTimer;
		var bDisableVideo = true;
		var viewVideoLocal, viewVideoRemote; // <video> (webrtc) or <div> (webrtc4all)
		var oConfigCall;
		var bFlashLoaded = false;
		var sipMLInited  = false;

	 window.onload = function () {
			if(window.console) {
				window.console.info("location=" + window.location);
			}
			videoLocal	= null;
			videoRemote = null;
			audioRemote = document.getElementById("audio_remote");


			// set debug level
			SIPml.setDebugLevel("info");		//"error"

			oReadyStateTimer = setInterval(function () {
				if (document.readyState === "complete") {
					clearInterval(oReadyStateTimer);
					// initialize SIPML5
					SIPml.init(postInit);
				}
			},
			500);
		};

		function postInit() {
			// check webrtc4all version
			if (SIPml.isWebRtc4AllSupported() && SIPml.isWebRtc4AllPluginOutdated()) {            
				if (confirm("Your WebRtc4all extension is outdated ("+SIPml.getWebRtc4AllVersion()+"). A new version with critical bug fix is available. Do you want to install it?\nIMPORTANT: You must restart your browser after the installation.")) {
					window.location = 'http://code.google.com/p/webrtc4all/downloads/list';
					return;
				}
			}

			// check for WebRTC support
			if (!SIPml.isWebRtcSupported()) {
				// is it chrome?
				if (SIPml.getNavigatorFriendlyName() == 'chrome') {
						if (confirm("You're using an old Chrome version or WebRTC is not enabled.\nDo you want to see how to enable WebRTC?")) {
							window.location = 'http://www.webrtc.org/running-the-demos';
						}
						else {
							window.location = "index.html";
						}
						return;
				}
					
				// for now the plugins (WebRTC4all only works on Windows)
				if (SIPml.getSystemFriendlyName() == 'windows') {
					// Internet explorer
					if (SIPml.getNavigatorFriendlyName() == 'ie') {
						// Check for IE version 
						if (parseFloat(SIPml.getNavigatorVersion()) < 9.0) {
							if (confirm("You are using an old IE version. You need at least version 9. Would you like to update IE?")) {
								window.location = 'http://windows.microsoft.com/en-us/internet-explorer/products/ie/home';
							}
							else {
								window.location = "index.html";
							}
						}

						// check for WebRTC4all extension
						if (!SIPml.isWebRtc4AllSupported()) {
							if (confirm("webrtc4all extension is not installed. Do you want to install it?\nIMPORTANT: You must restart your browser after the installation.")) {
								window.location = 'http://code.google.com/p/webrtc4all/downloads/list';
							}
							else {
								// Must do nothing: give the user the chance to accept the extension
								// window.location = "index.html";
							}
						}
						// break page loading ('window.location' won't stop JS execution)
						if (!SIPml.isWebRtc4AllSupported()) {
							return;
						}
					}
					else if (SIPml.getNavigatorFriendlyName() == "safari" || SIPml.getNavigatorFriendlyName() == "firefox" || SIPml.getNavigatorFriendlyName() == "opera") {
						if (confirm("Your browser don't support WebRTC.\nDo you want to install WebRTC4all extension to enjoy audio/video calls?\nIMPORTANT: You must restart your browser after the installation.")) {
							window.location = 'http://code.google.com/p/webrtc4all/downloads/list';
						}
						else {
							window.location = "index.html";
						}
						return;
					}
				}
				// OSX, Unix, Android, iOS...
				else {
					if (confirm('WebRTC not supported on your browser.\nDo you want to download a WebRTC-capable browser?')) {
						window.location = 'https://www.google.com/intl/en/chrome/browser/';
					}
					else {
						window.location = "index.html";
					}
					return;
				}
			}

			// checks for WebSocket support
			if (!SIPml.isWebSocketSupported() && !SIPml.isWebRtc4AllSupported()) {
				if (confirm('Your browser don\'t support WebSockets.\nDo you want to download a WebSocket-capable browser?')) {
					window.location = 'https://www.google.com/intl/en/chrome/browser/';
				}
				else {
					window.location = "index.html";
				}
				return;
			}

			// FIXME: displays must be per session

			// attachs video displays
			if (SIPml.isWebRtc4AllSupported()) {
				/*
				viewVideoLocal = document.getElementById("divVideoLocal");
				viewVideoRemote = document.getElementById("divVideoRemote");
				*/
				WebRtc4all_SetDisplays(null, null); // FIXME: move to SIPml.* API
			}
			else{
				viewVideoLocal = videoLocal;
				viewVideoRemote = videoRemote;
			}

			if (!SIPml.isWebRtc4AllSupported() && !SIPml.isWebRtcSupported()) {
				if (confirm('Your browser don\'t support WebRTC.\naudio/video calls will be disabled.\nDo you want to download a WebRTC-capable browser?')) {
					window.location = 'https://www.google.com/intl/en/chrome/browser/';
				}
			}
			
			oConfigCall = {
				audio_remote: audioRemote,
				video_local: viewVideoLocal,
				video_remote: viewVideoRemote,
				bandwidth: { audio:undefined, video:undefined },
				video_size: { minWidth:undefined, minHeight:undefined, maxWidth:undefined, maxHeight:undefined },
				events_listener: { events: '*', listener: onSipEventSession },
				sip_caps: [
								{ name: '+g.oma.sip-im' },
								{ name: '+sip.ice' },
								{ name: 'language', value: '\"en,fr\"' }
							]
			};
			
			if(bFlashLoaded == true)
				sipRegister();
			else
				sipMLInited = true;
		}

		function onLoadCompleted()
		{
			if(sipMLInited == true)
				sipRegister();
			else
				bFlashLoaded = true;
		}

		// sends SIP REGISTER request to login
		function sipRegister() {
			// catch exception for IE (DOM not ready)
			try {
				if (!releam || !username || !sip) 
				{
					return false;
				}
				var o_impu = tsip_uri.prototype.Parse(sip);
				if (!o_impu || !o_impu.s_user_name || !o_impu.s_host) {
					return false;
				}

				// enable notifications if not already done
				if (window.webkitNotifications && window.webkitNotifications.checkPermission() != 0) {
					window.webkitNotifications.requestPermission();
				}


				// update debug level to be sure new values will be used if the user haven't updated the page
				SIPml.setDebugLevel("info");  //or "error"

				// create SIP stack
				oSipStack = new SIPml.Stack({
						realm: releam,
						impi: username,
						impu: sip,
						password: password,
						display_name: fullname,
						websocket_proxy_url: "ws://115.186.163.171:8088/ws",
						outbound_proxy_url: "",
						ice_servers: "",
						enable_rtcweb_breaker: false,
						events_listener: { events: '*', listener: onSipEventStack },
						enable_early_ims: true, // Must be true unless you're using a real IMS network
						enable_media_stream_cache: true,
						bandwidth: null, // could be redefined a session-level
						video_size: null, // could be redefined a session-level
						sip_headers: [
								{ name: 'User-Agent', value: 'IM-client/OMA1.0 sipML5-v1.2013.08.10B' },
								{ name: 'Organization', value: 'Doubango Telecom' }
						]
					}
				);
				if (oSipStack.start() != 0) {
					return false;
				}
				else return true;
			}
			catch (e) {
				return false;
			}
			return false;
		}

		// sends SIP REGISTER (expires=0) to logout
		function sipUnRegister() {
			if (oSipStack) {
				oSipStack.stop(); // shutdown all sessions
			}
		}

		// makes a call (SIP INVITE)
		function sipCall(s_type, s_phoneNumber) {
			if (oSipStack && !oSipSessionCall && !tsk_string_is_null_or_empty(s_phoneNumber)) 
			{
				oConfigCall.bandwidth = tsk_string_to_object(""); // already defined at stack-level but redifined to use latest values
				oConfigCall.video_size = tsk_string_to_object(""); // already defined at stack-level but redifined to use latest values
				
				// create call session
				oSipSessionCall = oSipStack.newSession(s_type, oConfigCall);
				// make call
				if (oSipSessionCall.call(s_phoneNumber) != 0) {
					oSipSessionCall = null;
					return false;
				}
				return true;
			}
			else if (oSipSessionCall) {
				oSipSessionCall.accept(oConfigCall);
			}
		}


		  // Callback function for SIP Stacks
		function onSipEventStack(e /*SIPml.Stack.Event*/) {
			tsk_utils_log_info('==stack event = ' + e.type);
			switch (e.type) {
				case 'started':
					{
						// catch exception for IE (DOM not ready)
						try {
							// LogIn (REGISTER) as soon as the stack finish starting
							oSipSessionRegister = this.newSession('register', {
								expires: 200,
								events_listener: { events: '*', listener: onSipEventSession },
								sip_caps: [
											{ name: '+g.oma.sip-im', value: null },
											{ name: '+audio', value: null },
											{ name: 'language', value: '\"en,fr\"' }
									]
							});
							oSipSessionRegister.register();
						}
						catch (e) {
							txtRegStatus.value = txtRegStatus.innerHTML = "<b>1:" + e + "</b>";
							btnRegister.disabled = false;
						}
						break;
					}
				case 'stopping': case 'stopped': case 'failed_to_start': case 'failed_to_stop':
					{
						var bFailure = (e.type == 'failed_to_start') || (e.type == 'failed_to_stop');
						oSipStack = null;
						oSipSessionRegister = null;
						oSipSessionCall = null;

						uiOnConnectionEvent(false, false);

						Softphone.stopRingbackTone();		//Call Flex Function
						Softphone.stopRingTone();			//Call Flex Function

						txtCallStatus.innerHTML = '';
						txtRegStatus.innerHTML = bFailure ? "<i>Disconnected: <b>" + e.description + "</b></i>" : "<i>Disconnected</i>";
						break;
					}

				case 'i_new_call':
					{
						if (oSipSessionCall) {
							// do not accept the incoming call if we're already 'in call'
							e.newSession.hangup(); // comment this line for multi-line support
						}
						else {
							oSipSessionCall = e.newSession;

							// start listening for events
							oSipSessionCall.setConfiguration(oConfigCall);
							var sRemoteNumber = (oSipSessionCall.getRemoteFriendlyName() || 'unknown');
							Softphone.onNewCall(sRemoteNumber);
						}
						break;
					}

				case 'm_permission_requested':
					{
						//divGlassPanel.style.visibility = 'visible';
						break;
					}
				case 'm_permission_accepted':
				case 'm_permission_refused':
					{
						///divGlassPanel.style.visibility = 'hidden';
						if(e.type == 'm_permission_refused'){
							uiCallTerminated('Media stream permission denied');
						}
						break;
					}

				case 'starting': default: break;
			}
		};


	  function onSipEventSession(e /* SIPml.Session.Event */) {
			tsk_utils_log_info('==session event = ' + e.type);

			switch (e.type) {
				case 'connecting': case 'connected':
					{
						var bConnected = (e.type == 'connected');
						if (e.session == oSipSessionRegister) {
							uiOnConnectionEvent(bConnected, !bConnected);

							if(bConnected == true)
							{
								Softphone.onSipMLRegistered(true);
							}
						}
						else if (e.session == oSipSessionCall) 
						{
							if (bConnected) {
								Softphone.onCallAccepted();
								Softphone.stopRingbackTone();
								Softphone.stopRingTone();
							}
						}
						break;
					} // 'connecting' | 'connected'
				case 'terminating': 
				case 'terminated':
					{
						if (e.session == oSipSessionRegister) {
							uiOnConnectionEvent(false, false);

							oSipSessionCall = null;
							oSipSessionRegister = null;

							//txtRegStatus.innerHTML = "<i>" + e.description + "</i>";
						}
						else if (e.session == oSipSessionCall) {
							uiCallTerminated(e.description);
						}
						break;
					} // 'terminating' | 'terminated'


				case 'm_stream_audio_local_added':
				case 'm_stream_audio_local_removed':
				case 'm_stream_audio_remote_added':
				case 'm_stream_audio_remote_removed':
					{
						break;
					}

				case 'i_ect_new_call':
					{
						oSipSessionTransferCall = e.session;
						break;
					}

				case 'i_ao_request':
					{
						if(e.session == oSipSessionCall){
							var iSipResponseCode = e.getSipResponseCode();
							if (iSipResponseCode == 180 || iSipResponseCode == 183) {
								Softphone.startRingbackTone();
							}
						}
						break;
					}

				case 'm_early_media':
					{
						if(e.session == oSipSessionCall){
							Softphone.stopRingbackTone();
							Softphone.stopRingTone();
						}
						break;
					}

				case 'm_local_hold_ok':
					{
						if(e.session == oSipSessionCall){
							if (oSipSessionCall.bTransfering) {
								oSipSessionCall.bTransfering = false;
							}
							oSipSessionCall.bHeld = true;
						}
						break;
					}
				case 'm_local_hold_nok':
					{
						if(e.session == oSipSessionCall){
							oSipSessionCall.bTransfering = false;
						}
						break;
					}
				case 'm_local_resume_ok':
					{
						if(e.session == oSipSessionCall){
							oSipSessionCall.bTransfering = false;
							oSipSessionCall.bHeld = false;
						}
						break;
					}
				case 'm_local_resume_nok':
					{
						if(e.session == oSipSessionCall){
							oSipSessionCall.bTransfering = false;
						}	
						break;
					}
				}
			}


	 function uiOnConnectionEvent(b_connected, b_connecting) 
	 { 
		 /*
		 // should be enum: connecting, connected, terminating, terminated
		 btnRegister.disabled = b_connected || b_connecting;
		 btnUnRegister.disabled = !b_connected && !b_connecting;
		 btnCall.disabled = !(b_connected && tsk_utils_have_webrtc() && tsk_utils_have_stream());
		 btnHangUp.disabled = !oSipSessionCall;
		*/
	 }

	  function uiCallTerminated(s_description)
	  {

			oSipSessionCall = null;

			Softphone.stopRingbackTone();
			Softphone.stopRingTone();
			Softphone.onCallTerminated();
		}

	function sipHangUp() {
        if (oSipSessionCall) {
            oSipSessionCall.hangup({events_listener: { events: '*', listener: onSipEventSession }});
        }
    }

	function setVolume(volume)
	{
		audio_remote = volume;
	}

	</script>

</html>
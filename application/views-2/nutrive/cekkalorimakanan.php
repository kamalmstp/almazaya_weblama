<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>BENECOL</title>
		<style type="text/css">
html {
	background: url(<?=base_url("assets/frontend/images/bg.jpg")?>) no-repeat;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	min-height: 800px;
}
</style>
		<script type="text/javascript" src="<?=base_url("assets/frontend/js/swfobject.js")?>"></script>
		<script type="text/javascript">
			var swfVersionStr = "11.2.0";
			var xiSwfUrlStr = "";
			var flashvars = {};
			var params = {};
			params.quality = "high";
			params.play = "true";
			params.loop = "false";
			params.wmode = "transparent";
			params.scale = "noscale";
			params.menu = "false";
			params.devicefont = "false";
			params.salign = "t";
			params.allowscriptaccess = "always";
			var attributes = {};
			attributes.id = "FlashDiv";
			attributes.name = "FlashDiv";
			attributes.align = "top";
			swfobject.createCSS("html", "height:800px;");
			swfobject.createCSS("body", "margin:0; padding:0;  height:800px;");
			swfobject.embedSWF(
				"<?=base_url("assets/frontend/swf/quiz.swf")?>", "FlashDiv",
				"100%", "800px",
				swfVersionStr, xiSwfUrlStr,
				flashvars, params, attributes);
		</script>
		</head>
		<body  >
<div id="content">
          <div id="FlashDiv">
    <div id="noflash"> Ooops, halaman ini membutuhkan Flash Player 11. <br />
              Klik <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a> untuk download.</div>
  </div>
        </div>
</body>
</html>
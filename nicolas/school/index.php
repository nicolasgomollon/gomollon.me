<?php
	$subdomain = "school";
	$directory = "/var/www/html/nicolas" . DIRECTORY_SEPARATOR . $subdomain;
	
	$hide = array(
		'..',
		'.',
		'.htaccess',
		'cgi-bin',
		'error_log',
		'403.html',
		'404.html',
		'500.html',
		'index.php',
		'hacker',
	);
	
	$dont_traverse = array();
	
	$traverse_children = array(
		'digital-arts',
		'in4matx',
		'writing',
	);
	
	function scandirectory($dir, $files=true) {
		global $hide;
		$result = array_diff(scandir($dir), $hide);
		if (!$files) {
			$newresult = array();
			foreach ($result AS $item) {
				$subdir = $dir . DIRECTORY_SEPARATOR . $item;
				if (is_dir($subdir)) $newresult[] = $item;
			}
			$result = $newresult;
		}
		natsort($result);
		return $result;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Nicolas Gomollon &rsaquo; School &rsaquo; Index</title>
	<meta name="robots" content="noindex, nofollow" />
	<meta name="theme-color" content="#1e88ea" />
	<link rel="mask-icon" href="//gomollon.me/favicon.svg" color="#1e88ea" />
	<link rel="icon" type="image/png" href="//gomollon.me/favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
	<style type="text/css">
		@charset "utf-8";
		
		/**
		 * CSS Reset
		 *
		 * Eric Meyer
		 * http://meyerweb.com/eric/tools/css/reset/
		**/
		
		html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			vertical-align: baseline;
		}
		
		article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
			display: block;
		}
		
		ol, ul {
			list-style: none;
		}
		
		blockquote, q {
			quotes: none;
		}
		
		blockquote:before, blockquote:after, q:before, q:after {
			content: "";
			content: none;
		}
		
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		
		/** CSS Reset - End **/
		
		html {
			-webkit-text-size-adjust: none;
			-moz-text-size-adjust: none;
			-ms-text-size-adjust: none;
			-o-text-size-adjust: none;
			text-size-adjust: none;
		}
		
		body {
			background: #ffffff;
			color: #000000;
			font-family: system, -apple-system, -apple-system-font, BlinkMacSystemFont, "Helvetica Neue", "Helvetica", "Arial", sans-serif;
			font-size: 18pt;
			font-weight: 300;
			line-height: 1.5;
		}
		
		header, section {
			max-width: 300pt;
			margin: 0 auto;
		}
		
		header {
			padding-top: 20pt;
		}
		
		section {
			padding-bottom: 20pt;
		}
		
		h1 {
			margin-bottom: 0.75em;
			font-size: 20pt;
			text-align: center;
		}
		
		article {
			text-align: center;
			margin: 0 20pt;
			margin-bottom: 1em;
			overflow: hidden;
			
			background-color: #dedee3;
			border: 1pt solid #bbb9bb;
			color: #000000;
			
			-webkit-border-radius: 5pt;
			-moz-border-radius: 5pt;
			-ms-border-radius: 5pt;
			-o-border-radius: 5pt;
			border-radius: 5pt;
			
			-webkit-box-shadow: 0pt 1pt 4pt rgba(0, 0, 0, 0.25);
			-moz-box-shadow: 0pt 1pt 4pt rgba(0, 0, 0, 0.25);
			-ms-box-shadow: 0pt 1pt 4pt rgba(0, 0, 0, 0.25);
			-o-box-shadow: 0pt 1pt 4pt rgba(0, 0, 0, 0.25);
			box-shadow: 0pt 1pt 4pt rgba(0, 0, 0, 0.25);
		}
		
		div.buttons {
			display: flex;
			position: absolute;
			margin: 5px 4px;
		}
		
		div.buttons>div.close, div.buttons>div.minimize, div.buttons>div.maximize {
			margin: 0 4px;
			width: 12px; height: 12px;
			-webkit-border-radius: 20pt;
			-moz-border-radius: 20pt;
			-ms-border-radius: 20pt;
			-o-border-radius: 20pt;
			border-radius: 20pt;
		}
		
		div.buttons>div.close {
			background-color: #fc625d;
			border: 1px solid #de4643;
		}
		
		div.buttons>div.minimize {
			background-color: #fdbc40;
			border: 1px solid #dd9e33;
		}
		
		div.buttons>div.maximize {
			background-color: #34c84a;
			border: 1px solid #26a934;
		}
		
		div.title {
			margin: 0 auto;
			min-height: 24px;
			font-size: 11pt;
			font-weight: 400;
			line-height: 1.7em;
			cursor: default;
		}
		
		div.items {
			background-color: #ffffff;
			border-top: 1pt solid #bbb9bb;
			font-size: 11pt;
			font-weight: 400;
			line-height: 2em;
		}
		
		div.items>a, div.items>a:hover {
			display: block;
			color: #0881b3;
			text-decoration: none;
		}
		
		div.items>a:nth-child(odd) {
			background-color: #f5f5f5;
		}
		
		.floppy-disk {
			margin: auto;
			padding: 20px 0;
			background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODggMjg4Ij48cGF0aCBkPSJNMjc5IDI3OWgtMzZWMTUzaC05djEyNkg1NFYxNTNoLTl2MTI2SDlWOUgwdjI3OWgyNzl2LTkiLz48cGF0aCBkPSJNNTQgMTQ0aDE4MHY5SDU0ek0yNzkgMzZoOXYyNDNoLTl6bS05LTloOXY5aC05em0tOS05aDl2OWgtOXptLTktOWg5djloLTlNNzIgOTloMTM1djlINzJ6TTI1MiA5VjBIOXY5aDU0djkwaDlWOWgxMzV2OTBoOVY5aDM2Ii8+PHBhdGggZD0iTTE0NCAyN2g5djU0aC05em05IDU0aDI3djloLTI3em0yNy01NGg5djU0aC05em0tMjctOWgyN3Y5aC0yN20tMzYgMjI1di01NGgxOHYyN2g5di05aDl2LTloOXYtOWgxOHY5aC05djloLTl2OWgtOXY5aC05djloLTl2OWgtMTgiLz48L3N2Zz4=);
			background-position: center center;
			background-repeat: no-repeat;
			background-size: 144pt 144pt;
			width: 144pt; height: 144pt;
			max-width: 100%; max-height: 100%;
		}
		
		.floppy-disk-question {
			margin: auto;
			padding: 20px 0;
			background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODggMjg4Ij48cGF0aCBkPSJNMjc5IDI3OWgtMjdWMTM1aC05djE0NEg0NVYxMzVoLTl2MTQ0SDlWOUgwdjI3OWgyNzl2LTkiLz48cGF0aCBkPSJNNDUgMTI2aDE5OHY5SDQ1em0yMzQtOTBoOXYyNDNoLTl6bS05LTloOXY5aC05em0tOS05aDl2OWgtOXptLTktOWg5djloLTlNNzIgOTBoMTM1djlINzJ6TTI1MiA5VjBIOXY5aDU0djgxaDlWOWgxMzV2ODFoOVY5aDM2Ii8+PHBhdGggZD0iTTE0NCAyN2g5djQ1aC05em05IDQ1aDI3djloLTI3em0yNy00NWg5djQ1aC05em0tMjctOWgyN3Y5aC0yNyIvPjxwYXRoIGQ9Ik0xMzUgMjQzaDE4djE4aC0xOHptLTI3LTU0di0yN2g5di05aDU0djloOXYzNmgtOXY5aC05djloLTl2MThoLTE4di0yN2g5di05aDl2LTloOXYtMThoLTM2djE4aC0xOCIvPjwvc3ZnPg==);
			background-position: center center;
			background-repeat: no-repeat;
			background-size: 144pt 144pt;
			width: 144pt; height: 144pt;
			max-width: 100%; max-height: 100%;
		}
	</style>
</head>

<body>
	<header>
		<div class="floppy-disk-question"></div>
		<h1>Index of &ldquo;<?php echo $subdomain; ?>&rdquo;</h1>
	</header>
	<section>
<?php
	$contents = scandirectory($directory);
	foreach ($contents as $item) {
		$subdirectory = $directory . DIRECTORY_SEPARATOR . $item;
		if (is_dir($subdirectory)) {
			$subcontents = scandirectory($subdirectory);
			if ((count($subcontents) > 0) && !in_array($item, $dont_traverse)) { ?>
		<article>
			<div class="buttons">
				<div class="close"></div>
				<div class="minimize"></div>
				<div class="maximize"></div>
			</div>
			<div class="title"><?php echo $item; ?></div>
			<div class="items">
<?php			foreach ($subcontents as $subitem) {
					if (in_array($item, $traverse_children)) {
						$subsubdirectory = $subdirectory . DIRECTORY_SEPARATOR . $subitem;
						if (is_dir($subsubdirectory)) {
							$subsubcontents = scandirectory($subsubdirectory);
							if (count($subsubcontents) > 0) {
								foreach ($subsubcontents as $subsubitem) {
									if (in_array($subitem, $traverse_children)) {
										$subsubsubdirectory = $subsubdirectory . DIRECTORY_SEPARATOR . $subsubitem;
										if (is_dir($subsubsubdirectory)) {
											$subsubsubcontents = scandirectory($subsubsubdirectory);
											if (count($subsubsubcontents) > 0) {
												foreach ($subsubsubcontents as $subsubsubitem) {
													$sublink = $item . DIRECTORY_SEPARATOR . $subitem . DIRECTORY_SEPARATOR . $subsubitem . DIRECTORY_SEPARATOR . $subsubsubitem; ?>
				<a href="<?php echo $sublink; ?>"><?php echo $subitem . ": " . $subsubitem . ": " . $subsubsubitem; ?></a>
<?php											}
											} else { goto defaultsubsubitem; }
										} else { goto defaultsubsubitem; }
									} else {
defaultsubsubitem:
									$sublink = $item . DIRECTORY_SEPARATOR . $subitem . DIRECTORY_SEPARATOR . $subsubitem; ?>
				<a href="<?php echo $sublink; ?>"><?php echo $subitem . ": " . $subsubitem; ?></a>
<?php								}
								}
							} else { goto defaultsubitem; }
						} else { goto defaultsubitem; }
					} else {
defaultsubitem:
						$sublink = $item . DIRECTORY_SEPARATOR . $subitem; ?>
				<a href="<?php echo $sublink; ?>"><?php echo $subitem; ?></a>
<?php				}
				} ?>
			</div>
		</article>
<?php		} else { goto defaultitem; }
		} else {
defaultitem: ?>
		<article>
			<a class="title" href="<?php echo $item; ?>"><?php echo $item; ?></a>
		</article>
<?php	}
	} ?>
	</section>
</body>
</html>

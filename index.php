<?php
	require_once('vendor/php/vendor/autoload.php');
	ini_set('pcre.backtrack_limit', '1000000');

	// openssl_decrypt(hex2bin('8c7fe6b4cf4cd691df1fd64a90300088d0d7b78178fb2c3606e393c973beaf898d4f703cea28e1d12841da96939932c4fe7c325174a2'), 'AES-128-CBC', )

	$files = glob('tmp/*');

	foreach ($files as $file) {
  	if ( is_file($file) ) {
  		unlink($file);
  	}
  }

	function makeRandomString($max = 10) {
    $i = 0;
    $possible_keys = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $keys_length = strlen($possible_keys);
    $str = '';

    while ($i < $max) {
      $rand = mt_rand(1, $keys_length - 1);
      $str .= $possible_keys[$rand];
      
      $i++;
    }

    return $str;
  }

	function generate_layout($layout_type, $string) {
		require_once('vendor/php/phpqrcode/qrlib.php');

		// $string = file_get_contents('input.json');
		$json_a = json_decode($string);

		$body[] = <<<EOT
<html>
	<head>
		<link rel="stylesheet" href="dist/style.css">
	</head>
	<body>
EOT;

		if ($layout_type != 1) {
			$body[] = '<div class="wrapper-clearfix">';
		}

		switch ($layout_type) {
			case 2:
				$i = 0;

				foreach ($json_a as $key => $value) {
					$qr_tmp_path = 'tmp/'. makeRandomString() . '.png';
					$qr = QRcode::png($value->encryptedText, $qr_tmp_path, false, QR_ECLEVEL_H, 3, 4, false);
					$wrapper_class_name = '';

					if (++$i % 2 == 0) {
						$wrapper_class_name = ' wrapper--float-right';
					}

					$body[] .= <<<EOT
<style>
	.header__logo {
		height: 50px;
	}
</style>
<div class="wrapper wrapper--50 wrapper--landscape$wrapper_class_name">
	<div class="header">
		<img src="static/images/ItunesArtwork@2x-1024.png" alt="House Point System" class="header__logo">
		<div class="header__name">House Point System</div>
		<div class="header__student-name">$value->studentName</div>
	</div>
	<div class="body">
		<div class="body__left">
			<img src="static/images/iPhone-X-Mockup.png" alt="iPhone X Mockup" class="body__left-image">
		</div>
		<div class="body__right">
			<div class="body__right-title">Download<br>House Point System<br>to Connect to Your Students School</div>
			<ul class="body__right-list">
				<li class="body__right-line"></li>
				<li class="body__right-item">View House & Student Points</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">Track Your Students Daily Performance</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">View Your Schools House Photos</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">Chat with your Students Teacher</li>
				<li class="body__right-line"></li>
			</ul>
			<div class="body__right-download">
				<ul class="body__download-list">
					<li class="body__download-item">
						<a href="https://apps.apple.com/us/app/house-point-system/id1332788391" class="body__download-link">
							<img src="static/images/app-store-button1.png" alt="Available on the iPhone App Store" class="body__download-image">
						</a>
					</li>
					<li class="body__download-item">
						<a href="https://test.com" class="body__download-link">
							<img src="static/images/google-play-button.png" alt="Available on the iPhone App Store" class="body__download-image">
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="bottom">
		<ul class="bottom__qrs">
			<li class="bottom__qrs-item">
				<div class="bottom__qrs-left">
					<img src="static/images/QR-code-sample.jpg" alt="Download" class="bottom__qrs-image">
				</div>
				<div class="bottom__qrs-right">
					<div class="bottom__qrs-inner">
						<div class="bottom__qrs-title">
							<div class="bottom__title-step">Step 1</div>
							<div class="bottom__title-name">Download</div>
						</div>
						<div class="bottom__qrs-description">Scan this code with your mobile device to download House Point System</div>
					</div>
				</div>
			</li>
			<li class="bottom__qrs-item">
				<div class="bottom__qrs-left">
					<img src="$qr_tmp_path" alt="Download" class="bottom__qrs-image">
				</div>
				<div class="bottom__qrs-right">
					<div class="bottom__qrs-inner">
						<div class="bottom__qrs-title">
							<div class="bottom__title-step">Step 2</div>
							<div class="bottom__title-name">Sign Up & Link</div>
						</div>
						<div class="bottom__qrs-description">Scan this code with your mobile device to download House Point System</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<footer class="footer">Visit <a href="http://www.housepointsystem.com/" target="_blank" class="footer__link">www.housepointsystem.com</a> for more information</footer>
</div>
EOT;
				}

				break;

			case 4:
				$i = 0;

				foreach ($json_a as $key => $value) {
					$qr_tmp_path = 'tmp/'. makeRandomString() . '.png';
					$qr = QRcode::png($value->encryptedText, $qr_tmp_path, false, QR_ECLEVEL_H, 3, 4, false);
					$wrapper_class_name = '';

					if (++$i % 2 == 0) {
						$wrapper_class_name = ' wrapper--float-right';
					}

					$body[] .= <<<EOT
<style>
	.header__logo {
		height: 30px;
	}
</style>
<div class="wrapper wrapper--50$wrapper_class_name">
	<div class="header">
		<img src="static/images/ItunesArtwork@2x-1024.png" alt="House Point System" class="header__logo">
		<div class="header__name">House Point System</div>
		<div class="header__student-name">$value->studentName</div>
	</div>
	<div class="body">
		<div class="body__left">
			<img src="static/images/iPhone-X-Mockup.png" alt="iPhone X Mockup" class="body__left-image">
		</div>
		<div class="body__right">
			<div class="body__right-title">Download<br>House Point System<br>to Connect to Your Students School</div>
			<ul class="body__right-list">
				<li class="body__right-line"></li>
				<li class="body__right-item">View House & Student Points</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">Track Your Students Daily Performance</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">View Your Schools House Photos</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">Chat with your Students Teacher</li>
				<li class="body__right-line"></li>
			</ul>
			<div class="body__right-download">
				<ul class="body__download-list">
					<li class="body__download-item">
						<a href="https://apps.apple.com/us/app/house-point-system/id1332788391" class="body__download-link">
							<img src="static/images/app-store-button1.png" alt="Available on the iPhone App Store" class="body__download-image">
						</a>
					</li>
					<li class="body__download-item">
						<a href="https://test.com" class="body__download-link">
							<img src="static/images/google-play-button.png" alt="Available on the iPhone App Store" class="body__download-image">
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="bottom">
		<ul class="bottom__qrs">
			<li class="bottom__qrs-item">
				<div class="bottom__qrs-left">
					<img src="static/images/QR-code-sample.jpg" alt="Download" class="bottom__qrs-image">
				</div>
				<div class="bottom__qrs-right">
					<div class="bottom__qrs-inner">
						<div class="bottom__qrs-title">
							<div class="bottom__title-step">Step 1</div>
							<div class="bottom__title-name">Download</div>
						</div>
						<div class="bottom__qrs-description">Scan this code with your mobile device to download House Point System</div>
					</div>
				</div>
			</li>
			<li class="bottom__qrs-item">
				<div class="bottom__qrs-left">
					<img src="$qr_tmp_path" alt="Download" class="bottom__qrs-image">
				</div>
				<div class="bottom__qrs-right">
					<div class="bottom__qrs-inner">
						<div class="bottom__qrs-title">
							<div class="bottom__title-step">Step 2</div>
							<div class="bottom__title-name">Sign Up & Link</div>
						</div>
						<div class="bottom__qrs-description">Scan this code with your mobile device to download House Point System</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<footer class="footer">Visit <a href="http://www.housepointsystem.com/" target="_blank" class="footer__link">www.housepointsystem.com</a> for more information</footer>
</div>
EOT;
				}

				break;
			
			default:
				foreach ($json_a as $key => $value) {
					$qr_tmp_path = 'tmp/'. makeRandomString() . '.png';
					$qr = QRcode::png($value->encryptedText, $qr_tmp_path, false, QR_ECLEVEL_H, 3, 4, false);

					$body[] = <<<EOT
<div class="wrapper">
	<div class="header">
		<img src="static/images/ItunesArtwork@2x-1024.png" alt="House Point System" class="header__logo">
		<div class="header__name">House Point System</div>
		<div class="header__student-name">$value->studentName</div>
	</div>
	<div class="body">
		<div class="body__left">
			<img src="static/images/iPhone-X-Mockup.png" alt="iPhone X Mockup" class="body__left-image">
		</div>
		<div class="body__right">
			<div class="body__right-title">Download<br>House Point System to Connect to Your Students School</div>
			<ul class="body__right-list">
				<li class="body__right-line"></li>
				<li class="body__right-item">View House & Student Points</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">Track Your Students Daily Performance</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">View Your Schools House Photos</li>
				<li class="body__right-line"></li>
				<li class="body__right-item">Chat with your Students Teacher</li>
				<li class="body__right-line"></li>
			</ul>
			<div class="body__right-download">
				<ul class="body__download-list">
					<li class="body__download-item">
						<a href="https://apps.apple.com/us/app/house-point-system/id1332788391" class="body__download-link">
							<img src="static/images/app-store-button1.png" alt="Available on the iPhone App Store" class="body__download-image">
						</a>
					</li>
					<li class="body__download-item">
						<a href="https://test.com" class="body__download-link">
							<img src="static/images/google-play-button.png" alt="Available on the iPhone App Store" class="body__download-image">
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="bottom">
		<ul class="bottom__qrs">
			<li class="bottom__qrs-item">
				<div class="bottom__qrs-left">
					<img src="static/images/QR-code-sample.jpg" alt="Download" class="bottom__qrs-image">
				</div>
				<div class="bottom__qrs-right">
					<div class="bottom__qrs-inner">
						<div class="bottom__qrs-title">
							<div class="bottom__title-step">Step 1</div>
							<div class="bottom__title-name">Download</div>
						</div>
						<div class="bottom__qrs-description">Scan this code with your mobile device to download House Point System</div>
					</div>
				</div>
			</li>
			<li class="bottom__qrs-item">
				<div class="bottom__qrs-left">
					<img src="$qr_tmp_path" alt="Download" class="bottom__qrs-image">
				</div>
				<div class="bottom__qrs-right">
					<div class="bottom__qrs-inner">
						<div class="bottom__qrs-title">
							<div class="bottom__title-step">Step 2</div>
							<div class="bottom__title-name">Sign Up & Link</div>
						</div>
						<div class="bottom__qrs-description">Scan this code with your mobile device to download House Point System</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<footer class="footer">Visit <a href="http://www.housepointsystem.com/" target="_blank" class="footer__link">www.housepointsystem.com</a> for more information</footer>
</div>
EOT;
				}

				break;
		}

		if ($layout_type != 1) {
			$body[] = '</div>';
		}

		$body[] = <<<EOT
	</body>
</html>
EOT;
		
		return $body;
	}

	$defaultConfig = ( new Mpdf\Config\ConfigVariables() )->getDefaults();
	$fontDirs = $defaultConfig['fontDir'];
	$defaultFontConfig = ( new Mpdf\Config\FontVariables() )->getDefaults();
	$fontData = $defaultFontConfig['fontdata'];

	$layout_type = 1;
	$orientation = 'P';

	if ( isset($_POST['layout']) ) {
		$layout_type = $_POST['layout'];
	}

	if ($layout_type == 2) {
		$orientation = 'L';
	}

	if ( !isset($_POST['email']) ) {
		echo 'Email is mandatory';
	} else if ( !isset($_POST['QRData']) ) {
		echo 'QRData is mandatory';
	} else {
		$mpdf = new \Mpdf\Mpdf([
  	  'fontDir' => array_merge($fontDirs, [
  	    __DIR__ . '/src/fonts',
  	  ]),
  	  'fontdata' => $fontData + [
  	    'signika' => [
  	      'R' => 'Signika-Regular.ttf',
  	      'B' => 'Signika-Bold.ttf',
  	    ],
  	    'signikalight' => [
  	      'R' => 'Signika-Light.ttf',
  	      'B' => 'Signika-Semibold.ttf'
  	    ],
  	    'myriadpro' => [
  	    	'R' => 'MYRIADPRO-REGULAR.ttf'
  	    ]
  	  ],
  	  'default_font' => 'signika',
  	  'orientation' => $orientation
		]);
	
		$file_name = makeRandomString() . '.pdf';
		$body = generate_layout($layout_type, $_POST['QRData']);

		foreach ($body as $body_item) {
			$mpdf->WriteHTML($body_item);
		}
		
		$mpdf->Output('pdfs/' . $file_name, 'F');

		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		echo mail($_POST['email'], 'Generated new PDF', 'PDF Link: <a href="' . $actual_link . '/pdfs/' . $file_name . '">Download</a>', $headers);
	}
?>
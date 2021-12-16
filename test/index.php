<?php

require_once(__DIR__ . '/../src/Renderer.php');
require_once(__DIR__ . '/../src/Setting/CommonSettings.php');
require_once(__DIR__ . '/../src/Setting/ImageSettings.php');
require_once(__DIR__ . '/../src/Setting/PdfSettings.php');

if (!empty($_GET)) {
	$parameters = $_GET;
	unset($_GET);
	if (isset($parameters['export'])) {
		$tempFilename = null;
		$html = file_get_contents(__DIR__ . '/page.html');
		if ($parameters['export'] === 'pdf') {
			if (isset($parameters['page'])) {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PDF('https://github.com/');
			} else {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PDF($html, (new \Stanejoun\FileRenderer\Setting\PdfSettings())
					->setPageFormat('A4')
					->setOrientation('portrait')
				);
			}
		}
		if ($parameters['export'] === 'png') {
			if (isset($parameters['page'])) {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PNG('https://github.com/');
			} else {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PNG($html);
			}
		}
		if ($tempFilename) {
			header('Content-Description: File Transfer');
			header('Content-Disposition: inline; filename="' . $tempFilename . '"');
			header('Content-Type: application/force-download');
			header('Content-Disposition: attachment; filename=' . basename($tempFilename));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0, max-age=1');
			header('Pragma: public');
			header('Content-Length: ' . filesize($tempFilename));
			readfile($tempFilename);
		}
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>File renderer test</title>
	</head>
	<body>
		<div>
			<ul>
				<li><a href="page.html" target="_blank">Page 1</a></li>
				<li><a href="https://github.com/" target="_blank">www.github.com</a></li>
			</ul>
		</div>
		<div>
			<ul>
				<li><a href="index.php?export=pdf">Exporter la page 1 au format PDF</a></li>
				<li><a href="index.php?export=png">Exporter la page 1 au format PNG</a></li>
				<li><a href="index.php?export=pdf&page=php">Exporter la page www.github.com au format PDF</a></li>
				<li><a href="index.php?export=png&page=php">Exporter la page www.github.com au format PNG</a></li>
			</ul>
		</div>
	</body>
</html>

<?php

require_once(__DIR__ . '/vendor/stanejoun/file-renderer/src/Renderer.php');
require_once(__DIR__ . '/vendor/stanejoun/file-renderer/src/RendererSettings.php');

if (!empty($_GET)) {
	$parameters = $_GET;
	unset($_GET);
	if (isset($parameters['export'])) {
		$html = file_get_contents(__DIR__ . '/page.html');
		if ($parameters['export'] === 'pdf') {
			if (isset($parameters['page'])) {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PDF('https://www.buybox.net/', (new \Stanejoun\FileRenderer\RendererSettings())
					->setPdfWidth('40cm')
					->setPdfHeight('180.5cm')
				);
			} else {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PDF($html, (new \Stanejoun\FileRenderer\RendererSettings())
					->setPageFormat('A4')
					->setOrientation('portrait')
				);
			}
		}
		if ($parameters['export'] === 'png') {
			if (isset($parameters['page'])) {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PNG('https://www.buybox.net/', (new \Stanejoun\FileRenderer\RendererSettings()));
			} else {
				$tempFilename = Stanejoun\FileRenderer\Renderer::PNG($html, (new \Stanejoun\FileRenderer\RendererSettings()));
			}
		}
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>File renderer test</title>
	<style>


	</style>
</head>
<body class="body-a4-portrait">
<div>
	<ul>
		<li><a href="/page.html" target="_blank">Page 1</a></li>
		<li><a href="https://www.buybox.net/" target="_blank">www.buybox.net</a></li>
	</ul>
</div>
<div>
	<ul>
		<li><a href="index.php?export=pdf">Exporter la page 1 au format PDF</a></li>
		<li><a href="index.php?export=png">Exporter la page 1 au format PNG</a></li>
		<li><a href="index.php?export=pdf&page=php">Exporter la page www.buybox.net au format PDF</a></li>
		<li><a href="index.php?export=png&page=php">Exporter la page www.buybox.net au format PNG</a></li>
	</ul>
</div>
</body>
</html>

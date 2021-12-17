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
		$param = null;
		$target = (isset($parameters['content']) && $parameters['content'] == 1) ? file_get_contents('http://filerenderer/page.html') : 'http://filerenderer/page.html';
		if ($parameters['export'] === 'pdf') {
			if (isset($parameters['param'])) {
				if ($parameters['param'] == 0) {
					$param = (new \Stanejoun\FileRenderer\Setting\PdfSettings())
						->setPageFormat('[A4]');
				}
				if ($parameters['param'] == 1) {
					$param = (new \Stanejoun\FileRenderer\Setting\PdfSettings())
						->setWidth(900)
						->setHeight(1300);
				}
				if ($parameters['param'] == 2) {
					$param = (new \Stanejoun\FileRenderer\Setting\PdfSettings())
						->setWidth(992);
				}
				if ($parameters['param'] == 3) {
					$param = (new \Stanejoun\FileRenderer\Setting\PdfSettings())
						->setHeight(888);
				}
			}
			$tempFilename = Stanejoun\FileRenderer\Renderer::PDF($target, $param);
		}
		if ($parameters['export'] === 'png') {
			if (isset($parameters['param'])) {
				if ($parameters['param'] == 1) {
					$param = (new \Stanejoun\FileRenderer\Setting\ImageSettings())
						->setWidth(720)
						->setHeight(950);
				}
				if ($parameters['param'] == 2) {
					$param = (new \Stanejoun\FileRenderer\Setting\ImageSettings())
						->setWidth(653);
				}
				if ($parameters['param'] == 3) {
					$param = (new \Stanejoun\FileRenderer\Setting\ImageSettings())
						->setHeight(830);
				}
			}
			$tempFilename = Stanejoun\FileRenderer\Renderer::PNG($target, $param);
		}
		if ($parameters['export'] === 'html') {
			$tempFilename = Stanejoun\FileRenderer\Renderer::HTML($target);
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
			exit;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File renderer test</title>
	</head>
	<body>
		<div>
			<ul>
				<li><a href="page.html" target="_blank">Page</a></li>
			</ul>
		</div>
		<div>
			<ul>
				<li><a href="index.php?content=1&export=pdf&param=0">Export page to PDF [A4] by content</a></li>
				<li><a href="index.php?content=1&export=pdf&param=1">Export page to PDF [width*height] by content</a></li>
				<li><a href="index.php?content=1&export=pdf&param=2">Export page to PDF [width] by content</a></li>
				<li><a href="index.php?content=1&export=pdf&param=3">Export page to PDF [height] by content</a></li>
				<li><a href="index.php?content=1&export=pdf&param=4">Export page to PDF [null] by content</a></li>
			</ul>
			<ul>
				<li><a href="index.php?content=0&export=pdf&param=0">Export page to PDF [A4] by url</a></li>
				<li><a href="index.php?content=0&export=pdf&param=1">Export page to PDF [width*height] by url</a></li>
				<li><a href="index.php?content=0&export=pdf&param=2">Export page to PDF [width] by url</a></li>
				<li><a href="index.php?content=0&export=pdf&param=3">Export page to PDF [height] by url</a></li>
				<li><a href="index.php?content=0&export=pdf&param=4">Export page to PDF [null] by url</a></li>
			</ul>
			<ul>
				<li><a href="index.php?content=1&export=png&param=1">Export page to PNG [width*height] by content</a></li>
				<li><a href="index.php?content=1&export=png&param=2">Export page to PNG [width] by content</a></li>
				<li><a href="index.php?content=1&export=png&param=3">Export page to PNG [height] by content</a></li>
				<li><a href="index.php?content=1&export=png&param=4">Export page to PNG [null] by content</a></li>
			</ul>
			<ul>
				<li><a href="index.php?content=0&export=png&param=1">Export page to PNG [width*height] by url</a></li>
				<li><a href="index.php?content=0&export=png&param=2">Export page to PNG [width] by url</a></li>
				<li><a href="index.php?content=0&export=png&param=3">Export page to PNG [height] by url</a></li>
				<li><a href="index.php?content=0&export=png&param=4">Export page to PNG [null] by url</a></li>
			</ul>
			<ul>
				<li><a href="index.php?content=1&export=html">Export page to HTML by content</a></li>
				<li><a href="index.php?content=0&export=html">Export page to HTML by url</a></li>
			</ul>
		</div>
	</body>
</html>

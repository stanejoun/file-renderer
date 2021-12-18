<?php

require_once(__DIR__ . '/../src/Renderer.php');
require_once(__DIR__ . '/../src/RendererResult.php');
require_once(__DIR__ . '/../src/Setting/CommonSettings.php');
require_once(__DIR__ . '/../src/Setting/ImageSettings.php');
require_once(__DIR__ . '/../src/Setting/PdfSettings.php');

if (!empty($_GET)) {
	$parameters = $_GET;
	unset($_GET);
	if (isset($parameters['export'])) {
		$rendererResult = null;
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
						->setWidth(882);
				}
				if ($parameters['param'] == 3) {
					$param = (new \Stanejoun\FileRenderer\Setting\PdfSettings())
						->setHeight(888);
				}
			}
			$rendererResult = Stanejoun\FileRenderer\Renderer::PDF($target, $param);
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
			$rendererResult = Stanejoun\FileRenderer\Renderer::PNG($target, $param);
		}
		if ($parameters['export'] === 'html') {
			$rendererResult = Stanejoun\FileRenderer\Renderer::HTML($target);
		}
		if ($rendererResult) {
			\Stanejoun\FileRenderer\Renderer::Download($rendererResult);
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

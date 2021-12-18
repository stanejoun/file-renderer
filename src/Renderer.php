<?php

namespace Stanejoun\FileRenderer;

use Exception;
use Stanejoun\FileRenderer\Setting\CommonSettings;
use Stanejoun\FileRenderer\Setting\ImageSettings;
use Stanejoun\FileRenderer\Setting\PdfSettings;

class Renderer
{
	private static function Execute(string $target, string $extension, ?CommonSettings $settings = null): RendererResult
	{
		self::DeleteTmpFiles();
		if ($settings === null) {
			$settings = new CommonSettings();
		}
		$temporaryOutputFilename = self::GetFilename($extension);
		if (str_starts_with($target, 'http') || str_starts_with($target, 'www')) {
			$settings->setMode(CommonSettings::URL_MODE);
		} else {
			$target = base64_encode($target);
			$settings->setMode(CommonSettings::HTML_CONTENT_MODE);
		}
		$phantomJs = __DIR__ . '/../bin/phantomjs';
		$snapshotJs = __DIR__ . '/snapshot.js';
		$arguments = http_build_query($settings->toArray(), '', ',');
		$output = null;
		$status = null;
		exec("$phantomJs $snapshotJs $target $temporaryOutputFilename $arguments", $output, $status);
		if ($status !== 1) {
			throw new Exception('Error code: ' . $status . '; Error: ' . json_encode($output));
		}
		$stream = file_get_contents($temporaryOutputFilename);
		$rendererResult = new RendererResult($stream, basename($temporaryOutputFilename), $extension, filesize($temporaryOutputFilename));
		self::DeleteTmpFile($temporaryOutputFilename);
		self::DeleteTmpFiles();
		return $rendererResult;
	}

	public static function Download(RendererResult $rendererResult): void
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $rendererResult->filename . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . $rendererResult->filesize);
		echo $rendererResult->stream;
		exit;
	}

	public static function DeleteTmpFiles(): void
	{
		$tmpFiles = scandir(__DIR__ . '/../tmp');
		if (!empty($tmpFiles)) {
			foreach ($tmpFiles as $tmpFile) {
				$filename = __DIR__ . '/../tmp/' . $tmpFile;
				if (time() - filemtime($filename) > 5) {
					self::DeleteTmpFile($filename);
				}
			}
		}
	}

	public static function DeleteTmpFile(string $filename): void
	{
		if (!str_ends_with($filename, 'gitignore') && is_file($filename)) {
			unlink($filename);
		}
	}

	public static function GetFilename(string $extension): string
	{
		return __DIR__ . '/../tmp/' . date('Ymd-His') . '-' . uniqid() . '.' . $extension;
	}

	/**
	 * @param string $target url|html content
	 * @param PdfSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PDF(string $target, ?PdfSettings $settings = null): RendererResult
	{
		return self::Execute($target, 'pdf', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PNG(string $target, ?ImageSettings $settings = null): RendererResult
	{
		return self::Execute($target, 'png', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function JPG(string $target, ?ImageSettings $settings = null): RendererResult
	{
		return self::Execute($target, 'jpg', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function BMP(string $target, ?ImageSettings $settings = null): RendererResult
	{
		return self::Execute($target, 'bmp', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PPM(string $target, ?ImageSettings $settings = null): RendererResult
	{
		return self::Execute($target, 'ppm', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function GIF(string $target, ?ImageSettings $settings = null): RendererResult
	{
		return self::Execute($target, 'gif', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @return string
	 * @throws Exception
	 */
	public static function HTML(string $target): RendererResult
	{
		self::DeleteTmpFiles();
		if (str_starts_with($target, 'http') || str_starts_with($target, 'www')) {
			$content = file_get_contents($target);
		} else {
			$content = $target;
		}
		$filename = self::GetFilename('html');
		return new RendererResult($content, basename($filename), 'html', strlen($content));
	}
}
<?php

namespace Stanejoun\FileRenderer;

use Exception;

class Renderer
{
	private static function GetFilename(string $extension): string
	{
		return __DIR__ . '/../tmp/' . date('Ymd') . '-' . time() . '-' . uniqid() . '.' . $extension;
	}

	private static function Execute(string $target, string $extension, RendererSettings $settings): string
	{
		self::DeleteExpiredTempFiles();
		$temporaryOutputFilename = self::GetFilename($extension);
		if (str_starts_with($target, 'http') || str_starts_with($target, 'www')) {
			$target = base64_encode($target);
			$settings->setMode(RendererSettings::HTML_CONTENT_MODE);
		} else {
			$settings->setMode(RendererSettings::URL_MODE);
		}
		$phantomJs = __DIR__ . '/../bin/phantomjs';
		$snapshotJs = __DIR__ . '/snapshot.js';
		$arguments = http_build_query($settings->toArray(), '', ',');
		$output = null;
		$status = null;
		exec("$phantomJs $snapshotJs $target $temporaryOutputFilename $arguments", $output, $status);
		if ($status !== 1) {
			throw new Exception('Error code: ' . $status . '; error: ' . json_encode($output));
		}
		return $temporaryOutputFilename;
	}

	public static function DeleteExpiredTempFiles(): void
	{
		$tmpFiles = scandir(__DIR__ . '/../tmp');
		if (!empty($tmpFiles)) {
			foreach ($tmpFiles as $tmpFile) {
				$filename = __DIR__ . '/../tmp/' . $tmpFile;
				if (is_file($filename) && time() - filemtime($filename) > 10) {
					unlink($filename);
				}
			}
		}
	}

	/**
	 * @param string $target url|html content
	 * @param RendererSettings $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PDF(string $target, RendererSettings $settings): string
	{
		return self::Execute($target, 'pdf', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param RendererSettings $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PNG(string $target, RendererSettings $settings): string
	{
		return self::Execute($target, 'png', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param RendererSettings $settings
	 * @return string
	 * @throws Exception
	 */
	public static function JPG(string $target, RendererSettings $settings): string
	{
		return self::Execute($target, 'jpg', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param RendererSettings $settings
	 * @return string
	 * @throws Exception
	 */
	public static function BMP(string $target, RendererSettings $settings): string
	{
		return self::Execute($target, 'bmp', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param RendererSettings $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PPM(string $target, RendererSettings $settings): string
	{
		return self::Execute($target, 'ppm', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param RendererSettings $settings
	 * @return string
	 * @throws Exception
	 */
	public static function GIF(string $target, RendererSettings $settings): string
	{
		return self::Execute($target, 'gif', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param RendererSettings $settings
	 * @return string
	 * @throws Exception
	 */
	public static function HTML(string $target, RendererSettings $settings): string
	{
		return '';
	}
}
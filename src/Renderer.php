<?php

namespace Stanejoun\FileRenderer;

use Exception;
use Stanejoun\FileRenderer\Setting\CommonSettings;
use Stanejoun\FileRenderer\Setting\ImageSettings;
use Stanejoun\FileRenderer\Setting\PdfSettings;

class Renderer
{
	private static function GetFilename(string $extension): string
	{
		return __DIR__ . '/../tmp/' . date('Ymd-His') . '-' . uniqid() . '.' . $extension;
	}

	private static function Execute(string $target, string $extension, ?CommonSettings $settings = null): string
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
		return $temporaryOutputFilename;
	}

	public static function DeleteTmpFiles(): void
	{
		$tmpFiles = scandir(__DIR__ . '/../tmp');
		if (!empty($tmpFiles)) {
			foreach ($tmpFiles as $tmpFile) {
				$filename = __DIR__ . '/../tmp/' . $tmpFile;
				if (!str_ends_with($filename, 'gitignore') && is_file($filename) && time() - filemtime($filename) > 10) {
					unlink($filename);
				}
			}
		}
	}

	/**
	 * @param string $target url|html content
	 * @param PdfSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PDF(string $target, ?PdfSettings $settings = null): string
	{
		return self::Execute($target, 'pdf', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PNG(string $target, ?ImageSettings $settings = null): string
	{
		return self::Execute($target, 'png', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function JPG(string $target, ?ImageSettings $settings = null): string
	{
		return self::Execute($target, 'jpg', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function BMP(string $target, ?ImageSettings $settings = null): string
	{
		return self::Execute($target, 'bmp', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function PPM(string $target, ?ImageSettings $settings = null): string
	{
		return self::Execute($target, 'ppm', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @param ImageSettings|null $settings
	 * @return string
	 * @throws Exception
	 */
	public static function GIF(string $target, ?ImageSettings $settings = null): string
	{
		return self::Execute($target, 'gif', $settings);
	}

	/**
	 * @param string $target url|html content
	 * @return string
	 * @throws Exception
	 */
	public static function HTML(string $target): string
	{
		self::DeleteTmpFiles();
		if (str_starts_with($target, 'http') || str_starts_with($target, 'www')) {
			$content = file_get_contents($target);
		} else {
			$content = $target;
		}
		$filename = self::GetFilename('html');
		file_put_contents($filename, $content);
		return $filename;
	}
}
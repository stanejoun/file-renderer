<?php

namespace Stanejoun\FileRenderer;

class RendererResult
{
	public string $stream;
	public string $filename;
	public string $extension;
	public int $filesize;

	public function __construct($stream, $filename, $extension, $filesize)
	{
		$this->stream = $stream;
		$this->filename = $filename;
		$this->extension = $extension;
		$this->filesize = $filesize;
	}
}
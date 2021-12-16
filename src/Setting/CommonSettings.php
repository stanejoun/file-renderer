<?php

namespace Stanejoun\FileRenderer\Setting;

class CommonSettings
{
	const HTML_CONTENT_MODE = 'content';
	const URL_MODE = 'url';

	protected ?int $width = null;
	protected ?int $height = null;
	protected ?int $zoomFactor = null;
	protected ?string $mode = null;

	public function toArray(): array
	{
		return [
			'width' => $this->width,
			'height' => $this->height,
			'zoomFactor' => $this->zoomFactor,
			'mode' => $this->mode
		];
	}

	public function getWidth(): ?int
	{
		return $this->width;
	}

	public function setWidth(?int $width): CommonSettings
	{
		$this->width = $width;
		return $this;
	}

	public function getHeight(): ?int
	{
		return $this->height;
	}

	public function setHeight(?int $height): CommonSettings
	{
		$this->height = $height;
		return $this;
	}

	public function getZoomFactor(): ?int
	{
		return $this->zoomFactor;
	}

	public function setZoomFactor(?int $zoomFactor): CommonSettings
	{
		$this->zoomFactor = $zoomFactor;
		return $this;
	}

	public function getMode(): ?string
	{
		return $this->mode;
	}

	public function setMode(?string $mode): CommonSettings
	{
		$this->mode = $mode;
		return $this;
	}
}
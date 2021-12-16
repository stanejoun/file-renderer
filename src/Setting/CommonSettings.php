<?php

namespace Stanejoun\FileRenderer\Setting;

class CommonSettings
{
	const HTML_CONTENT_MODE = 'content';
	const URL_MODE = 'url';

	protected ?int $zoomFactor = null;
	protected ?string $mode = null;

	public function toArray(): array {
		return [
			'zoomFactor' => $this->zoomFactor,
			'mode' => $this->mode
		];
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
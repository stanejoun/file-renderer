<?php

namespace Stanejoun\FileRenderer\Setting;

class ImageSettings extends CommonSettings
{
	private ?int $top = null;
	private ?int $left = null;
	private ?int $width = null;
	private ?int $height = null;

	public function toArray(): array
	{
		return array_merge(parent::toArray(), [
			'top' => $this->top,
			'left' => $this->left,
			'width' => $this->width,
			'height' => $this->height
		]);
	}

	public function getTop(): ?int
	{
		return $this->top;
	}

	public function setTop(?int $top): ImageSettings
	{
		$this->top = $top;
		return $this;
	}

	public function getLeft(): ?int
	{
		return $this->left;
	}

	public function setLeft(?int $left): ImageSettings
	{
		$this->left = $left;
		return $this;
	}

	public function getWidth(): ?int
	{
		return $this->width;
	}

	public function setWidth(?int $width): ImageSettings
	{
		$this->width = $width;
		return $this;
	}

	public function getHeight(): ?int
	{
		return $this->height;
	}

	public function setHeight(?int $height): ImageSettings
	{
		$this->height = $height;
		return $this;
	}
}
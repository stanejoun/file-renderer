<?php

namespace Stanejoun\FileRenderer\Setting;

class ImageSettings extends CommonSettings
{
	private ?int $top = null;
	private ?int $left = null;

	public function toArray(): array
	{
		return array_merge(parent::toArray(), [
			'top' => $this->top,
			'left' => $this->left
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
}
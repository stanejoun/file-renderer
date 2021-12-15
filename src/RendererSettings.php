<?php

namespace Stanejoun\FileRenderer;

class RendererSettings
{
	public ?int $top = null;
	public ?int $left = null;
	public ?int $width = null;
	public ?int $height = null;
	public ?string $pdfWidth = null; // 21cm
	public ?string $pdfHeight = null; // 29.7cm
	public ?int $pageFormat = null; // A4
	public ?string $orientation = null; // portrait
	public ?int $zoomFactor = null;
	public ?int $isContent = null;

	public function toArray(): array
	{
		$array = [];
		$properties = ['top', 'left', 'width', 'height', 'pdfWidth', 'pdfHeight', 'pageFormat', 'orientation', 'zoomFactor', 'isContent'];
		foreach ($properties as $property) {
			if (!empty($this->{$property})) {
				$array[$property] = $this->{$property};
			}
		}
		return $array;
	}

	public function top(?int $top): RendererSettings
	{
		$this->top = $top;
		return $this;
	}

	public function left(?int $left): RendererSettings
	{
		$this->left = $left;
		return $this;
	}

	public function width(?int $width): RendererSettings
	{
		$this->width = $width;
		return $this;
	}

	public function height(?int $height): RendererSettings
	{
		$this->height = $height;
		return $this;
	}

	public function pdfWidth(?string $pdfWidth): RendererSettings
	{
		$this->pdfWidth = $pdfWidth;
		return $this;
	}

	public function pdfHeight(?string $pdfHeight): RendererSettings
	{
		$this->pdfHeight = $pdfHeight;
		return $this;
	}

	public function pageFormat(?int $pageFormat): RendererSettings
	{
		$this->pageFormat = $pageFormat;
		return $this;
	}

	public function orientation(?string $orientation): RendererSettings
	{
		$this->orientation = $orientation;
		return $this;
	}

	public function zoomFactor(?int $zoomFactor): RendererSettings
	{
		$this->zoomFactor = $zoomFactor;
		return $this;
	}

	public function isContent(?int $isContent): RendererSettings
	{
		$this->isContent = $isContent;
		return $this;
	}
}
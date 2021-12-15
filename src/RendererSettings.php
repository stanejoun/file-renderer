<?php

namespace Stanejoun\FileRenderer;

class RendererSettings
{
	const HTML_CONTENT_MODE = 'content';
	const URL_MODE = 'content';

	private ?int $top = null;
	private ?int $left = null;
	private ?int $width = null;
	private ?int $height = null;
	private ?string $pdfWidth = null; // 21cm
	private ?string $pdfHeight = null; // 29.7cm
	private ?string $pageFormat = null; // A4
	private ?string $orientation = null; // portrait
	private ?int $zoomFactor = null;
	private ?string $mode = null;

	public function toArray(): array
	{
		$array = [];
		$properties = ['top', 'left', 'width', 'height', 'pdfWidth', 'pdfHeight', 'pageFormat', 'orientation', 'zoomFactor', 'mode'];
		foreach ($properties as $property) {
			if (!empty($this->{$property})) {
				$array[$property] = $this->{$property};
			}
		}
		return $array;
	}

	public function getTop(): ?int
	{
		return $this->top;
	}

	public function setTop(?int $top): RendererSettings
	{
		$this->top = $top;
		return $this;
	}

	public function getLeft(): ?int
	{
		return $this->left;
	}

	public function setLeft(?int $left): RendererSettings
	{
		$this->left = $left;
		return $this;
	}

	public function getWidth(): ?int
	{
		return $this->width;
	}

	public function setWidth(?int $width): RendererSettings
	{
		$this->width = $width;
		return $this;
	}

	public function getHeight(): ?int
	{
		return $this->height;
	}

	public function setHeight(?int $height): RendererSettings
	{
		$this->height = $height;
		return $this;
	}

	public function getPdfWidth(): ?string
	{
		return $this->pdfWidth;
	}

	public function setPdfWidth(?string $pdfWidth): RendererSettings
	{
		$this->pdfWidth = $pdfWidth;
		return $this;
	}

	public function getPdfHeight(): ?string
	{
		return $this->pdfHeight;
	}

	public function setPdfHeight(?string $pdfHeight): RendererSettings
	{
		$this->pdfHeight = $pdfHeight;
		return $this;
	}

	public function getPageFormat(): ?string
	{
		return $this->pageFormat;
	}

	public function setPageFormat(?string $pageFormat): RendererSettings
	{
		$this->pageFormat = $pageFormat;
		return $this;
	}

	public function getOrientation(): ?string
	{
		return $this->orientation;
	}

	public function setOrientation(?string $orientation): RendererSettings
	{
		$this->orientation = $orientation;
		return $this;
	}

	public function getZoomFactor(): ?int
	{
		return $this->zoomFactor;
	}

	public function setZoomFactor(?int $zoomFactor): RendererSettings
	{
		$this->zoomFactor = $zoomFactor;
		return $this;
	}

	public function getMode(): ?int
	{
		return $this->mode;
	}

	public function setMode(?int $mode): RendererSettings
	{
		$this->mode = $mode;
		return $this;
	}
}
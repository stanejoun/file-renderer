<?php

namespace Stanejoun\FileRenderer;

class RendererSettings
{
	private ?int $_top = null;
	private ?int $_left = null;
	private ?int $_width = null;
	private ?int $_height = null;
	private ?string $_pdfWidth = null; // 21cm
	private ?string $_pdfHeight = null; // 29.7cm
	private ?int $_pageFormat = null; // A4
	private ?string $_orientation = null; // portrait
	private ?int $_zoomFactor = null;
	private ?int $_isContent = null;

	public function toArray(): array
	{
		$array = [];
		$properties = ['_top', '_left', '_width', '_height', '_pdfWidth', '_pdfHeight', '_pageFormat', '_orientation', '_zoomFactor', '_isContent'];
		foreach ($properties as $property) {
			if (!empty($this->{$property})) {
				$array[$property] = $this->{$property};
			}
		}
		return $array;
	}

	public function top(?int $top): RendererSettings
	{
		$this->_top = $top;
		return $this;
	}

	public function left(?int $left): RendererSettings
	{
		$this->_left = $left;
		return $this;
	}

	public function width(?int $width): RendererSettings
	{
		$this->_width = $width;
		return $this;
	}

	public function height(?int $height): RendererSettings
	{
		$this->_height = $height;
		return $this;
	}

	public function pdfWidth(?string $pdfWidth): RendererSettings
	{
		$this->_pdfWidth = $pdfWidth;
		return $this;
	}

	public function pdfHeight(?string $pdfHeight): RendererSettings
	{
		$this->_pdfHeight = $pdfHeight;
		return $this;
	}

	public function pageFormat(?int $pageFormat): RendererSettings
	{
		$this->_pageFormat = $pageFormat;
		return $this;
	}

	public function orientation(?string $orientation): RendererSettings
	{
		$this->_orientation = $orientation;
		return $this;
	}

	public function zoomFactor(?int $zoomFactor): RendererSettings
	{
		$this->_zoomFactor = $zoomFactor;
		return $this;
	}

	public function isContent(?int $isContent): RendererSettings
	{
		$this->_isContent = $isContent;
		return $this;
	}

	public function getTop(): ?int
	{
		return $this->_top;
	}

	public function getLeft(): ?int
	{
		return $this->_left;
	}

	public function getWidth(): ?int
	{
		return $this->_width;
	}

	public function getHeight(): ?int
	{
		return $this->_height;
	}

	public function getPdfWidth(): ?string
	{
		return $this->_pdfWidth;
	}

	public function getPdfHeight(): ?string
	{
		return $this->_pdfHeight;
	}

	public function getPageFormat(): ?int
	{
		return $this->_pageFormat;
	}

	public function getOrientation(): ?string
	{
		return $this->_orientation;
	}

	public function getZoomFactor(): ?int
	{
		return $this->_zoomFactor;
	}

	public function getIsContent(): ?int
	{
		return $this->_isContent;
	}
}
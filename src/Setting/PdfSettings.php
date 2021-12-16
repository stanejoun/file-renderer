<?php

namespace Stanejoun\FileRenderer\Setting;

class PdfSettings extends CommonSettings
{
	/** @var string|null value with cm unit */
	private ?string $width = null; //value with unit cm
	/** @var string|null value with cm unit */
	private ?string $height = null; //value with unit cm
	/** @var string|null A3|A4|A5|Legal|Letter|Tabloid */
	private ?string $pageFormat = null; // A4
	/** @var string|null portrait|landscape */
	private ?string $orientation = null; // portrait

	public function toArray(): array
	{
		return array_merge(parent::toArray(), [
			'width' => $this->width,
			'height' => $this->height,
			'pageFormat' => $this->pageFormat,
			'orientation' => $this->orientation
		]);
	}

	/**
	 * @return string|null value with cm unit
	 */
	public function getWidth(): ?string
	{
		return $this->width;
	}

	/**
	 * @param string|null $width value with cm unit
	 * @return PdfSettings
	 */
	public function setWidth(?string $width): PdfSettings
	{
		$this->width = $width;
		return $this;
	}

	/**
	 * @return string|null value with cm unit
	 */
	public function getHeight(): ?string
	{
		return $this->height;
	}

	/**
	 * @param string|null $height value with cm unit
	 * @return PdfSettings
	 */
	public function setHeight(?string $height): PdfSettings
	{
		$this->height = $height;
		return $this;
	}

	/**
	 * @return string|null A3|A4|A5|Legal|Letter|Tabloid
	 */
	public function getPageFormat(): ?string
	{
		return $this->pageFormat;
	}

	/**
	 * @param string|null $pageFormat A3|A4|A5|Legal|Letter|Tabloid
	 * @return PdfSettings
	 */
	public function setPageFormat(?string $pageFormat): PdfSettings
	{
		$this->pageFormat = $pageFormat;
		return $this;
	}

	/**
	 * @return string|null portrait|landscape
	 */
	public function getOrientation(): ?string
	{
		return $this->orientation;
	}

	/**
	 * @param string|null $orientation portrait|landscape
	 * @return PdfSettings
	 */
	public function setOrientation(?string $orientation): PdfSettings
	{
		$this->orientation = $orientation;
		return $this;
	}
}
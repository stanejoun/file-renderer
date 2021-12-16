<?php

namespace Stanejoun\FileRenderer\Setting;

class PdfSettings extends CommonSettings
{
	/** @var string|null A3|A4|A5|Legal|Letter|Tabloid */
	private ?string $pageFormat = null; // A4
	/** @var string|null portrait|landscape */
	private ?string $orientation = null; // portrait

	public function toArray(): array
	{
		return array_merge(parent::toArray(), [
			'pageFormat' => $this->pageFormat,
			'orientation' => $this->orientation
		]);
	}

	public function getPageFormat(): ?string
	{
		return $this->pageFormat;
	}

	public function setPageFormat(?string $pageFormat): PdfSettings
	{
		$this->pageFormat = $pageFormat;
		return $this;
	}

	public function getOrientation(): ?string
	{
		return $this->orientation;
	}

	public function setOrientation(?string $orientation): PdfSettings
	{
		$this->orientation = $orientation;
		return $this;
	}
}
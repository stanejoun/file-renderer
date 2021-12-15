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
}
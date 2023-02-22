<?php

namespace ExternalResources\FPDF;


interface GroupedPDFInterface
{
    public function setRemovePageNumbers($removePageNumbers);
    public function setPreviewDocument($previewDocument);
    public function isBatchMode();
    public function setBatchMode($batchMode);
    public function getFooterImage();
    public function setFooterImage($footerImage);
    public function getFooterImageYPosition();
    public function setFooterImageYPosition($footerImageYPosition);

}
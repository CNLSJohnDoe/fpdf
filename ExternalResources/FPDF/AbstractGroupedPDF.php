<?php

namespace ExternalResources\FPDF;


abstract class AbstractGroupedPDF
    extends FPDFGroupPages
    implements GroupedPDFInterface,
    PdfLogoInterface,
    PdfAddressInterface,
    PdfHeaderInterface

{
    use PdfHeaderTrait;
    use PdfLogoTrait;
    use PdfAddressTrait;

    protected $batchMode = false;
    /** @var bool */
    protected $showFooterImage = true;
    protected $footerImage;
    protected $footerImageYPosition;
    private $removePageNumbers;
    private $previewDocument;

    public function setRemovePageNumbers($removePageNumbers)
    {
        $this->removePageNumbers = $removePageNumbers;
    }

    public function setPreviewDocument($previewDocument)
    {
        $this->previewDocument = $previewDocument;
    }

    /**
     * @return bool
     */
    public function isBatchMode()
    {
        return $this->batchMode;
    }

    /**
     * @param bool $batchMode
     * @return $this
     */
    public function setBatchMode($batchMode)
    {
        $this->batchMode = $batchMode;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldShowFooterImage()
    {
        return $this->showFooterImage;
    }

    /**
     * @param bool $showFooterImage
     * @return $this
     */
    public function setShowFooterImage($showFooterImage)
    {
        $this->showFooterImage = $showFooterImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFooterImage()
    {
        return $this->footerImage;
    }

    /**
     * @param mixed $footerImage
     * @return $this
     */
    public function setFooterImage($footerImage)
    {
        $this->footerImage = $footerImage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFooterImageYPosition()
    {
        return $this->footerImageYPosition;
    }

    /**
     * @param mixed $footerImageYPosition
     * @return $this
     */
    public function setFooterImageYPosition($footerImageYPosition)
    {
        $this->footerImageYPosition = $footerImageYPosition;
        return $this;
    }

    //Page header
    public function Header()
    {
        // Add the preview text if it is in preview mode
        // Note: As text, table are added this preview text will be overlapped by them.
        if ($this->previewDocument == "Y") {
            $this->SetFont('Arial', 'B', 50);
            $this->SetTextColor(255, 192, 203);
            $this->RotatedText(80, 130, 'P r e v i e w', 45);
        }

        if ($this->GroupPageNo() == 1){
            $this->addLogo();
            $this->addAddress();
        }
    }

    public function Footer()
    {
        if (!$this->removePageNumbers) {
            $this->SetY(-15);
            //Arial italic 8
            $pdffont = "Arial";
            $this->SetFont($pdffont, '', 8);
            //Page number
            $this->Cell(
                0,
                10,
                'Page '.$this->GroupPageNo() . '/' . $this->PageGroupAlias(),
                0,
                0,
                $this->getPageNumberAlignment()
            );

            $footerImage = $this->getFooterImage();
            if (
                ($this->GroupPageNo() == 1) && !empty($footerImage) && $this->shouldShowFooterImage()
            ){
                $this->Image($footerImage, 0, $this->getFooterImageYPosition(), 210, 0);
            }

        }

//        // Add the preview text if it is in preview mode
//        // Note: The issue with the "preview" text in header, does not exist with footer.
//        if ($this->previewDocument == "Y") {
//            $this->SetFont('Arial', 'B', 50);
//            $this->SetTextColor(255, 192, 203);
////            $this->RotatedText(80, 130, 'P r e v i e w', 45);
//        }
    }

    var $angle = 0;

    function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1) {
            $x = $this->x;
        }
        if ($y == -1) {
            $y = $this->y;
        }
        if ($this->angle != 0) {
            $this->_out('Q');
        }
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy,
                -$cx, -$cy));
        }
    }

    function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    function RotatedText($x, $y, $txt, $angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

}
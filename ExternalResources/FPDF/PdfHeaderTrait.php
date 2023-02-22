<?php


namespace ExternalResources\FPDF;


trait PdfHeaderTrait
{
    /** @var boolean */
    protected $showHeaderImage = false;

    /**
     * @return bool
     */
    public function shouldShowHeaderImage()
    {
        return $this->showHeaderImage;
    }

    /**
     * @param bool $showHeaderImage
     */
    public function setShowHeaderImage($showHeaderImage)
    {
        $this->showHeaderImage = $showHeaderImage;
        return $this;
    }
}
<?php


namespace ExternalResources\FPDF;


trait PdfLogoTrait
{

    /** @var string */
    protected $logoImage;
    /** @var string */
    protected $logoYPosition;
    /** @var string */
    protected $logoXPosition;
    /** @var string */
    protected $logoWidth;
    /** @var string */
    protected $logoHeight;

    /**
     * @return string
     */
    public function getLogoImage()
    {
        return $this->logoImage;
    }

    /**
     * @param string $logoImage
     */
    public function setLogoImage($logoImage)
    {
        $this->logoImage = $logoImage;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoYPosition()
    {
        return $this->logoYPosition;
    }

    /**
     * @param string $logoYPosition
     */
    public function setLogoYPosition($logoYPosition)
    {
        $this->logoYPosition = $logoYPosition;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoXPosition()
    {
        return $this->logoXPosition;
    }

    /**
     * @param string $logoXPosition
     */
    public function setLogoXPosition($logoXPosition)
    {
        $this->logoXPosition = $logoXPosition;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoWidth()
    {
        return $this->logoWidth;
    }

    /**
     * @param string $logoWidth
     */
    public function setLogoWidth($logoWidth)
    {
        $this->logoWidth = $logoWidth;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoHeight()
    {
        return $this->logoHeight;
    }

    /**
     * @param string $logoHeight
     */
    public function setLogoHeight($logoHeight)
    {
        $this->logoHeight = $logoHeight;
        return $this;
    }

    public function addLogo()
    {
        if(!empty($this->getLogoImage()) && $this->shouldShowHeaderImage()){
            $this->Image($this->getLogoImage(),
                $this->getLogoXPosition(),
                $this->getLogoYPosition(),
                $this->getLogoWidth(),
                $this->getLogoHeight()
            );
        }
    }
}
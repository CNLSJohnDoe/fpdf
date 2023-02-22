<?php


namespace ExternalResources\FPDF;


trait PdfAddressTrait
{
    /** @var boolean */
    protected $showCompanyAddress = false;
    /** @var string */
    protected $companyPDFTitle;
    /** @var string */
    protected $companyPDFAddress;
    /** @var integer */
    protected $addressY;
    /** @var integer */
    protected $addressX;
    /** @var string */
    protected $larn;

    /**
     * @return boolean
     */
    public function shouldShowCompanyAddress()
    {
        return $this->showCompanyAddress;
    }

    /**
     * @param boolean $showCompanyAddress
     */
    public function setShowCompanyAddress($showCompanyAddress)
    {
        $this->showCompanyAddress = $showCompanyAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyPDFTitle()
    {
        return $this->companyPDFTitle;
    }

    /**
     * @param string $companyPDFTitle
     */
    public function setCompanyPDFTitle($companyPDFTitle)
    {
        $this->companyPDFTitle = $companyPDFTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyPDFAddress()
    {
        return $this->companyPDFAddress;
    }

    /**
     * @param string $companyPDFAddress
     */
    public function setCompanyPDFAddress($companyPDFAddress)
    {
        $this->companyPDFAddress = $companyPDFAddress;
        return $this;
    }

    /**
     * @return integer
     */
    public function getAddressY()
    {
        return $this->addressY;
    }

    /**
     * @param integer $addressY
     */
    public function setAddressY($addressY)
    {
        $this->addressY = $addressY;
        return $this;
    }

    /**
     * @return integer
     */
    public function getAddressX()
    {
        return $this->addressX;
    }

    /**
     * @param integer $addressX
     */
    public function setAddressX($addressX)
    {
        $this->addressX = $addressX;
        return $this;
    }

    /**
     * @return string
     */
    public function getLarn()
    {
        return $this->larn;
    }

    /**
     * @param string $larn
     */
    public function setLarn($larn)
    {
        $this->larn = $larn;
        return $this;
    }

    public function addAddress()
    {
        if($this->shouldShowCompanyAddress()){
            $addressText = "";

            if(!empty($this->companyPDFTitle)){
                $addressText .= $this->companyPDFTitle;
                $addressText .= PHP_EOL;
            }

            $addressText .= $this->companyPDFAddress;

            if(!empty($this->getLarn())){
                $addressText.= PHP_EOL . "LARN:" . $this->getLarn();
            }

            $addressText .= PHP_EOL;
            $addressText .= PHP_EOL;
            $addressText .= (new \DateTime())->format("d F Y");
            $addressText .= PHP_EOL;

            $pdffont = "Arial";
            $this->SetFont($pdffont, '', $this->FontSizePt);

            $this->SetY($this->getAddressY());
            $this->SetX($this->getAddressX());
            $this->MultiCell((210-($this->getAddressX()-$this->rMargin)), 5, $addressText, 0, 'L');
            $this->Ln(6);
        }
    }
}
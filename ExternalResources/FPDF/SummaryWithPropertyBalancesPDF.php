<?php

namespace ExternalResources\FPDF;


class SummaryWithPropertyBalancesPDF extends AbstractGroupedPDF implements GroupedPDFInterface {

    /**
     * Normally document date should be part of a Document model
     * (e.g. SummaryWithPropertyBalancesDocument) but this is
     * special case where it is required to be in footer.
     *
     * @var \DateTime
     */
    protected $documentDate;

    /**
     * @return \DateTime
     */
    public function getDocumentDate()
    {
        return $this->documentDate;
    }

    /**
     * @param \DateTime $documentDate
     * @return SummaryWithPropertyBalancesPDF
     */
    public function setDocumentDate($documentDate)
    {
        $this->documentDate = $documentDate;
        return $this;
    }

    public function Footer()
    {
        parent::Footer();
        $this->SetY(-15);
        $this->Cell(
            0,
            10,
            'Reconciliation report generated: ' . $this->getDocumentDate()->format('jS F Y, H:i'),
            0,
            0,
            'L'
        );
    }
}
<?php
namespace fpdf\ExternalResources;

class FPDFGroupPages extends FPDF
{
    private $NewPageGroup;   // variable indicating whether a new group was requested
    private $PageGroups;     // variable containing the number of pages of the groups
    private $CurrPageGroup;  // variable containing the alias of the current page group
    private $pageNumberAlignment = 'C';

    /**
     * @return string
     */
    public function getPageNumberAlignment()
    {
        return $this->pageNumberAlignment;
    }

    /**
     * @param string $pageNumberAlignment
     * @return FPDFGroupPages
     */
    public function setPageNumberAlignment($pageNumberAlignment)
    {
        $this->pageNumberAlignment = $pageNumberAlignment;
        return $this;
    }

    // create a new page group; call this before calling AddPage()
    function StartPageGroup()
    {
        $this->NewPageGroup = true;
    }

    // current page in the group
    function GroupPageNo()
    {
        return $this->PageGroups[$this->CurrPageGroup];
    }

    // alias of the current page group -- will be replaced by the total number of pages in this group
    function PageGroupAlias()
    {
        return $this->CurrPageGroup;
    }

    function _beginpage($orientation)
    {
        parent::_beginpage($orientation);
        if($this->NewPageGroup)
        {
            // start a new group
            $n = sizeof($this->PageGroups)+1;
            $alias = "{nb$n}";
            $this->PageGroups[$alias] = 1;
            $this->CurrPageGroup = $alias;
            $this->NewPageGroup=false;
        }
        elseif($this->CurrPageGroup)
            $this->PageGroups[$this->CurrPageGroup]++;
    }

    function _putpages()
    {
        $nb = $this->page;
        if (!empty($this->PageGroups))
        {
            // do page number replacement
            foreach ($this->PageGroups as $k => $v)
            {
                for ($n = 1; $n <= $nb; $n++)
                {
                    $this->pages[$n]=str_replace($k, $v, $this->pages[$n]);
                }
            }
        }
        parent::_putpages();
    }

}
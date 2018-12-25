<?php
/**
 * This file is part of deved/fattura-elettronica
 *
 * Copyright (c) Salvatore Guarino <sg@deved.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaHeader;

use Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaHeader\Common\DatiAnagrafici;
use Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaHeader\Common\Sede;
use Deved\FatturaElettronica\XmlSerializableInterface;

class CedentePrestatore implements XmlSerializableInterface
{
    /** @var DatiAnagrafici */
    protected $datiAnagrafici;
    /** @var Sede */
    protected $sede;
	/** @var string|null */
    protected $riferimentoAmministrazione;

    /**
     * CedentePrestatore constructor.
     * @param DatiAnagrafici $datiAnagrafici
     * @param Sede $sede
     */
    public function __construct(
        DatiAnagrafici $datiAnagrafici,
        Sede $sede,
        $riferimentoAmministrazione
    ) {
        $this->datiAnagrafici = $datiAnagrafici;
        $this->sede = $sede;
        $this->riferimentoAmministrazione = $riferimentoAmministrazione;
    }

    /**
     * @param \XMLWriter $writer
     * @return \XMLWriter
     */
    public function toXmlBlock(\XMLWriter $writer)
    {
        $writer->startElement('CedentePrestatore');
            $this->datiAnagrafici->toXmlBlock($writer);
            $this->sede->toXmlBlock($writer);
            if (isset($this->riferimentoAmministrazione)) $writer->writeElement("RiferimentoAmministrazione", $this->riferimentoAmministrazione);
        $writer->endElement();
        return $writer;
    }
}

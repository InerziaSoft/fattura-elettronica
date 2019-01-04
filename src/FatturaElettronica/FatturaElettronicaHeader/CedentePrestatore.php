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

use Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaHeader\CedentePrestatore\IscrizioneRea;
use Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaHeader\Common\DatiAnagrafici;
use Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaHeader\Common\Sede;
use Deved\FatturaElettronica\Traits\MagicFieldsTrait;
use Deved\FatturaElettronica\XmlSerializableInterface;

class CedentePrestatore implements XmlSerializableInterface
{
    use MagicFieldsTrait;
    /** @var DatiAnagrafici */
    protected $datiAnagrafici;
    /** @var Sede */
    protected $sede;
	/** @var string|null */
    protected $rifAmministrazione126;
    /** @var IscrizioneRea */
    protected $iscrizioneRea;


	/**
	 * CedentePrestatore constructor.
	 * @param DatiAnagrafici $datiAnagrafici
	 * @param Sede $sede
	 * @param null $rifAmministr126
	 * @param IscrizioneRea $iscrizioneRea
	 */
    public function __construct(
        DatiAnagrafici $datiAnagrafici,
        Sede $sede,
		$rifAmministr126 = null,
        IscrizioneRea $iscrizioneRea = null
    ) {
        $this->datiAnagrafici = $datiAnagrafici;
        $this->sede = $sede;
        $this->rifAmministrazione126 = $rifAmministr126;
        $this->iscrizioneRea = $iscrizioneRea;
    }

	/**
	 * @param string $rifAdmin
	 */
    public function setRiferimentoAmministrazione ($rifAdmin) {
    	$this->rifAmministrazione126 = $rifAdmin;
	}

    /**
     * @param IscrizioneRea $iscrizioneRea
     */
    public function setIscrizioneRea(IscrizioneRea $iscrizioneRea)
    {
        $this->iscrizioneRea = $iscrizioneRea;
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
            if ($this->iscrizioneRea) {
                $this->iscrizioneRea->toXmlBlock($writer);
            }
			if ($this->rifAmministrazione126) {
				$writer->writeElement("RiferimentoAmministrazione", $this->rifAmministrazione126);
			}
            $this->writeXmlFields($writer);
        $writer->endElement();
        return $writer;
    }
}

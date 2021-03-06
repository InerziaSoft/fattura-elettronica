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

namespace Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaBody;

use Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaBody\DatiGenerali\DatiDdt;
use Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaBody\DatiGenerali\DatiOrdineAcquisto;
use Deved\FatturaElettronica\Traits\MagicFieldsTrait;
use Deved\FatturaElettronica\XmlSerializableInterface;

class DatiGenerali implements XmlSerializableInterface
{
    use MagicFieldsTrait;
    /** @var string */
    protected $tipoDocumento;
    /** @var string */
    protected $data;
    /** @var string */
    protected $numero;
    /** @var float */
    protected $importoTotaleDocumento;
    /** @var string */
    protected $causale;
    /** @var string */
    protected $divisa;
    /** @var DatiBollo */
    protected $datiBollo;
	/** @var DatiDdt */
	protected $datiDdt;
	/** @var DatiOrdineAcquisto */
	protected $datiOrdineAcquisto;

	/**
	 * DatiGenerali constructor.
	 * @param string $tipoDocumento
	 * @param string $data
	 * @param string $numero
	 * @param float $importoTotaleDocumento
	 * @param string $divisa
	 * @param DatiBollo $datiBollo
	 * @param DatiOrdineAcquisto $datiOrdineAcquisto
	 * @param array $causale
	 */
    public function __construct($tipoDocumento, $data, $numero, $importoTotaleDocumento, $divisa = 'EUR', $datiBollo = null, $datiOrdineAcquisto = null, $causale = null)
	{
        $this->tipoDocumento = $tipoDocumento;
        $this->data = $data;
        $this->numero = $numero;
        $this->importoTotaleDocumento = $importoTotaleDocumento;
        $this->divisa = $divisa;
        $this->datiBollo = $datiBollo;
        $this->datiOrdineAcquisto = $datiOrdineAcquisto;
        $this->causale = $causale;
    }

    public function setDatiDdt(DatiDdt $datiDdt)
    {
        $this->datiDdt = $datiDdt;
    }

    public function setDatiAcquisto(DatiOrdineAcquisto $datiOrdineAcquisto)
	{
		$this->datiOrdineAcquisto = $datiOrdineAcquisto;
	}

    /**
     * @param \XMLWriter $writer
     * @return \XMLWriter
     */
    public function toXmlBlock(\XMLWriter $writer)
    {
        $writer->startElement('DatiGenerali');
            $writer->startElement('DatiGeneraliDocumento');
                $writer->writeElement('TipoDocumento', $this->tipoDocumento);
                $writer->writeElement('Divisa', $this->divisa);
                $writer->writeElement('Data', $this->data);
                $writer->writeElement('Numero', $this->numero);
                if ($this->datiBollo) {
					$this->datiBollo->toXmlBlock($writer);
				}
                $writer->writeElement('ImportoTotaleDocumento', fe_number_format($this->importoTotaleDocumento, 2));
            	if ($this->causale && count($this->causale) > 0) {
			foreach ($this->causale as $line) {
				$writer->writeElement("Causale", $line);
			}
		}
                $this->writeXmlFields($writer);
            $writer->endElement();
            if ($this->datiOrdineAcquisto) {
            	$this->datiOrdineAcquisto->toXmlBlock($writer);
			}
            if ($this->datiDdt) {
                $this->datiDdt->toXmlBlock($writer);
            }
        $writer->endElement();
        //todo: implementare DatiContratto etc. (facoltativi)
        return $writer;
    }
}

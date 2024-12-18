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

namespace Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaHeader\Common;

use Deved\FatturaElettronica\Traits\MagicFieldsTrait;
use Deved\FatturaElettronica\XmlSerializableInterface;

class DatiAnagrafici implements XmlSerializableInterface
{
    use MagicFieldsTrait;
    /** @var string */
    public $codiceFiscale;
    /** @var string */
    public $denominazione;
    /** @var string */
    public $idPaese;
    /** @var string */
    public $idCodice;
    /** @var string */
    public $regimeFiscale;
    /** @var string  */
    public $titolo;

    public function __construct(
        $codiceFiscale,
        $denominazione,
        $idPaese = '',
        $idCodice = '',
        $regimeFiscale = '',
        $titolo = ''
    ) {
        $this->codiceFiscale = $codiceFiscale;
        $this->denominazione = $denominazione;
        $this->idPaese = $idPaese;
        $this->idCodice = $idCodice;
        $this->regimeFiscale = $regimeFiscale;
        $this->titolo = $titolo;
    }

    /**
     * @param \XMLWriter $writer
     * @return \XMLWriter
     */
    public function toXmlBlock(\XMLWriter $writer)
    {
    	$vatCodeExists = ($this->idCodice && $this->idPaese);
    	$fiscalCodeExists = ($this->codiceFiscale);
        $writer->startElement('DatiAnagrafici');
        if ($vatCodeExists) {
            $writer->startElement('IdFiscaleIVA');
                $writer->writeElement('IdPaese', $this->idPaese);
                $writer->writeElement('IdCodice', $this->idCodice);
            $writer->endElement();
        }
        if ($fiscalCodeExists) {
			$writer->writeElement('CodiceFiscale', $this->codiceFiscale);
		}

		$writer->startElement('Anagrafica');
		if (!$vatCodeExists) {
			$nomi = explode(" ", $this->denominazione, 2);
			$writer->writeElement('Nome', $nomi[0]);
			$writer->writeElement('Cognome', $nomi[1]);
            if ($this->titolo) {
                $writer->writeElement('Titolo', $this->titolo);
            }
		}
		else {
			$writer->writeElement('Denominazione', $this->denominazione);
		}
		$writer->endElement();
        if ($this->regimeFiscale) {
            $writer->writeElement('RegimeFiscale', $this->regimeFiscale);
        }
        $this->writeXmlFields($writer);
        $writer->endElement();
        return $writer;
    }
}

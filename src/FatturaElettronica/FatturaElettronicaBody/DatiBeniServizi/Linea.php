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

namespace Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaBody\DatiBeniServizi;

use Deved\FatturaElettronica\XmlSerializableInterface;

class Linea implements XmlSerializableInterface
{
    /** @var integer */
    protected $numeroLinea;
    /** @var string */
    protected $codiceArticolo;
    /** @var string */
    protected $descrizione;
    /** @var float */
    protected $quantita;
    /** @var string */
    protected $unitaMisura;
    /** @var float */
    protected $prezzoUnitario;
    /** @var float */
    protected $aliquotaIva;
    /** @var string */
    protected $natura;
	
	
	/**
	 * Linea constructor.
	 * @param $descrizione
	 * @param $prezzoUnitario
	 * @param null $codiceArticolo
	 * @param float $quantita
	 * @param string $unitaMisura
	 * @param float $aliquotaIva
	 * @param string $natura
	 */
    public function __construct(
        $descrizione,
        $prezzoUnitario,
        $codiceArticolo = null,
        $quantita = 1.00,
        $unitaMisura = null,
        $aliquotaIva = 22.00,
		$natura = null
    ) {
        $this->codiceArticolo = $codiceArticolo;
        $this->descrizione = $descrizione;
        $this->prezzoUnitario = $prezzoUnitario;
        $this->quantita = $quantita;
        $this->unitaMisura = $unitaMisura;
        $this->aliquotaIva = $aliquotaIva;
        $this->natura = $natura;
    }


    /**
     * @param \XMLWriter $writer
     * @return \XMLWriter
     */
    public function toXmlBlock(\XMLWriter $writer)
    {
        $writer->startElement('DettaglioLinee');
        $writer->writeElement('NumeroLinea', $this->numeroLinea);
        if ($this->codiceArticolo) {
            $writer->startElement('CodiceArticolo');
                $writer->writeElement('CodiceTipo', 'FORN');
                //todo: implementare altri tipi di codice
                $writer->writeElement('CodiceValore', $this->codiceArticolo);
            $writer->endElement();
        }
        $writer->writeElement('Descrizione', $this->descrizione);
        $writer->writeElement('Quantita', number_format($this->quantita, 2, ".", ""));
        if (isset($this->unitaMisura)) $writer->writeElement('UnitaMisura', $this->unitaMisura);
        $writer->writeElement('PrezzoUnitario', number_format($this->prezzoUnitario, 2, ".", ""));
        $writer->writeElement('PrezzoTotale', $this->prezzoTotale());
        $writer->writeElement('AliquotaIVA', number_format($this->aliquotaIva, 2, ".", ""));
        $writer->writeElement("Natura", $this->natura);
        $writer->endElement();

        return $writer;
    }

    /**
     * Calcola e restituisce il prezzo totale della linea
     *
     * @param bool $format
     * @return string | float
     */
    public function prezzoTotale($format = true)
    {
        if ($format) {
            return number_format($this->prezzoUnitario * $this->quantita, 2, ".", "");
        }
        return $this->prezzoUnitario * $this->quantita;
    }

    /**
     * Imposta il numero riga
     *
     * @param integer $n
     */
    public function setNumeroLinea($n)
    {
        $this->numeroLinea = $n;
    }

    /**
     * Restituisce Aliquota IVA
     *
     * @return float
     */
    public function getAliquotaIva()
    {
        return $this->aliquotaIva;
    }
}

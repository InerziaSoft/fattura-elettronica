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

class DatiRiepilogo implements XmlSerializableInterface
{
    /** @var float */
    protected $aliquotaIVA;
    /** @var float */
    protected $imponibileImporto;
    /** @var float */
    protected $imposta;
    /** @var string */
    protected $esigibilitaIVA = "I";
    /** @var string */
    protected $natura;
	
	/**
	 * DatiRiepilogo constructor.
	 * @param $imponibileImporto
	 * @param $aliquotaIVA
	 * @param string $esigibilitaIVA
	 * @param bool $imposta
	 * @param string $natura
	 */
    public function __construct($imponibileImporto, $aliquotaIVA, $esigibilitaIVA = null, $imposta = false, $natura = null)
    {
        if ($imposta === false) {
            $this->imposta = ($imponibileImporto / 100) * $aliquotaIVA;
        } else {
            $this->imposta = $imposta;
        }
        $this->imponibileImporto = $imponibileImporto;
        $this->aliquotaIVA = $aliquotaIVA;
        $this->esigibilitaIVA = $esigibilitaIVA;
        $this->natura = $natura;
    }

    /**
     * @param \XMLWriter $writer
     * @return \XMLWriter
     */
    public function toXmlBlock(\XMLWriter $writer)
    {
        $writer->startElement('DatiRiepilogo');
            $writer->writeElement('AliquotaIVA', number_format($this->aliquotaIVA, 2, ".", ""));
            $writer->writeElement('ImponibileImporto', number_format($this->imponibileImporto, 2, ".", ""));
            $writer->writeElement('Imposta', number_format($this->imposta, 2, ".", ""));
            if (isset($this->esigibilitaIVA)) {
                $writer->writeElement('EsigibilitaIVA', $this->esigibilitaIVA);
            }
            if (isset($this->natura)) {
                $writer->writeElement("Natura", $this->natura);
            }
        $writer->endElement();

        return $writer;
    }
}

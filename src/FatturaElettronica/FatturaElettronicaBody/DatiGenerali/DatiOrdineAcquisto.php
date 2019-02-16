<?php
/**
 * Created by PhpStorm.
 * User: massimo
 * Date: 2/11/19
 * Time: 7:21 PM
 */

namespace Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaBody\DatiGenerali;


use Deved\FatturaElettronica\Traits\MagicFieldsTrait;
use Deved\FatturaElettronica\XmlSerializableInterface;

class DatiOrdineAcquisto implements XmlSerializableInterface, \Countable, \Iterator
{
	use MagicFieldsTrait;

	/** @var DatiOrdineAcquisto[] */
	protected $datiOrdineAcquisto = [];
	/** @var int */
	protected $riferimentoNumeroLinea;
	/** @var string */
	protected $IdDocumento;
	/** @var string */
	protected $data;
	/** @var sring */
	protected $numItem;
	/** @var string */
	protected $codiceCommessaConvenzione;
	/** @var string */
	protected $codiceCUP;
	/** @var string */
	protected $codiceCIG;
	/** @var int */
	protected $currentIndex;

	/**
	 * DatiOrdineAcquisto constructor.
	 * @param $riferimentoLinea int
	 * @param $idDocumento string
	 * @param $data string
	 * @param $numItem string
	 * @param $codiceCommessa string
	 * @param $codiceCUP string
	 * @param $codiceCIG string
	 */
	public function __construct($riferimentoLinea, $idDocumento, $data=null, $numItem=null, $codiceCommessa=null, $codiceCUP=null, $codiceCIG=null)
	{
		$this->riferimentoNumeroLinea = $riferimentoLinea;
		$this->IdDocumento = $idDocumento;
		$this->data = $data;
		$this->numItem = $numItem;
		$this->codiceCommessaConvenzione = $codiceCommessa;
		$this->codiceCUP = $codiceCUP;
		$this->codiceCIG = $codiceCIG;
		$this->datiOrdineAcquisto[] = $this;
	}

	public function addDatiOrdineAcquisto(DatiOrdineAcquisto $dati)
	{
		$this->datiOrdineAcquisto[] = $dati;
	}

	public function toXmlBlock(\XMLWriter $writer)
	{
		/** @var DatiOrdineAcquisto $block */
		foreach ($this as $block) {
			$writer->startElement("DatiOrdineAcquisto");
				if ($block->riferimentoNumeroLinea != 0) {
					$writer->writeElement('RiferimentoNumeroLinea', $block->riferimentoNumeroLinea);
				}
				if ($block->IdDocumento != "") {
					$writer->writeElement('IdDocumento', $block->IdDocumento);
				}
				if ($block->data != "") {
					$writer->writeElement('Data', $block->data);
				}
				if ($block->numItem != "") {
					$writer->writeElement('NumItem', $block->numItem);
				}
				if ($block->codiceCommessaConvenzione != "") {
					$writer->writeElement('CodiceCommessaConvenzione', $block->codiceCommessaConvenzione);
				}
				if ($block->codiceCUP != "") {
					$writer->writeElement('CodiceCUP', $block->codiceCUP);
				}
				if ($block->codiceCIG) {
					$writer->writeElement('CodiceCIG', $block->codiceCIG);
				}
			$writer->endElement();
		}
		return $writer;
	}

	public function current()
	{
		return $this->datiOrdineAcquisto[$this->currentIndex];
	}

	public function next()
	{
		$this->currentIndex++;
	}

	public function key()
	{
		return $this->currentIndex;
	}

	public function valid()
	{
		return isset($this->datiOrdineAcquisto[$this->currentIndex]);
	}

	public function rewind()
	{
		$this->currentIndex = 0;
	}

	public function count()
	{
		return count($this->datiOrdineAcquisto);
	}
}
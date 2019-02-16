<?php


namespace Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaBody\DatiBeniServizi;


use Deved\FatturaElettronica\XmlSerializableInterface;

class AltriDatiGestionali implements \Countable, \Iterator, XmlSerializableInterface
{
	/** @var string maxlength=10*/
	private $tipoDato;
	/** @var string maxLength=60*/
	private $riferimentoTesto;
	/** @var float [4..21]*/
	private $riferimentoNumero;
	/** @var string length=10*/
	private $riferimentoData;
	/** @var array */
	private $altriDatiGestionali;
	/** @var int */
	private $currentIndex;

	public function __construct($tipoDato, $riferimentoTesto=null, $riferimentoNumero=null, $riferimentoData=null)
	{
		$this->tipoDato = $tipoDato;
		$this->riferimentoTesto = $riferimentoTesto;
		$this->riferimentoNumero = $riferimentoNumero;
		$this->riferimentoData = $riferimentoData;
		$this->altriDatiGestionali[] = $this;
	}

	public function addAltriDatiGestionali(AltriDatiGestionali $altriDatiGestionali) {
		$this->altriDatiGestionali[] = $altriDatiGestionali;
	}

	public function toXmlBlock(\XMLWriter $writer)
	{
		/** @var AltriDatiGestionali $block */
		foreach ($this as $block) {
			$writer->startElement("AltriDatiGestionali");
				$writer->writeElement("TipoDato", $this->tipoDato);
				if ($this->riferimentoTesto) {
					$writer->writeElement("RiferimentoTesto", $this->riferimentoTesto);
				}
				if ($this->riferimentoNumero) {
					$writer->writeElement("RiferimentoNumero", $this->riferimentoNumero);
				}
				if ($this->riferimentoData) {
					$writer->writeElement("RiferimentoData", $this->riferimentoData);
				}
			$writer->endElement();
		}
	}

	public function current()
	{
		return $this->altriDatiGestionali[$this->currentIndex];
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
		return isset($this->altriDatiGestionali[$this->currentIndex]);
	}

	public function rewind()
	{
		$this->currentIndex = 0;
	}

	public function count()
	{
		return count($this->altriDatiGestionali);
	}
}
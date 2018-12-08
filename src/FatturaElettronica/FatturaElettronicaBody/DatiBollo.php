<?php
/*
MIT License

Copyright (c) 2016 Alessio Moiso, Andrea Gai - InerziaSoft

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

namespace Deved\FatturaElettronica\FatturaElettronica\FatturaElettronicaBody;


use Deved\FatturaElettronica\XmlSerializableInterface;

class DatiBollo implements XmlSerializableInterface {
	
	/** @var boolean */
	protected $bolloVirtuale;
	/** @var float */
	protected $importoBollo;
	
	public function __construct(
		$bolloVirtuale = false,
		$importoBollo = 0
	) {
		$this->bolloVirtuale = $bolloVirtuale;
		$this->importoBollo = $importoBollo;
	}
	
	/**
	 * @param \XMLWriter $writer
	 * @return \XMLWriter
	 */
	public function toXmlBlock(\XMLWriter $writer) {
		$writer->startElement("DatiBollo");
			$writer->writeElement("BolloVirtuale", $this->bolloVirtuale);
			$writer->writeElement("ImportoBollo", number_format($this->importoBollo, 2));
		$writer->endElement();
		return $writer;
	}
}
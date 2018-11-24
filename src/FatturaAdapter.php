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

namespace Deved\FatturaElettronica;


class FatturaAdapter
{
    /** @var FatturaInterface */
    protected $fattura;

    public function __construct(FatturaInterface $fattura)
    {
        $this->fattura = $fattura;
    }

    public function toXml()
    {
        //todo: implementare
    }
}
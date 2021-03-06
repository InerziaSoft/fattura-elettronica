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

namespace Deved\FatturaElettronica\Codifiche;


use Deved\FatturaElettronica\Traits\CodificaTrait;

abstract class Natura
{
    use CodificaTrait;

    const EscluseArt15 = 'N1';
    const NonSoggette = 'N2.1';     //non soggette artt. 7
    const NonImponibili = 'N3.4';   //non imponibili cessione all'esportazione
    const Esenti = 'N4';
    const RegimeDelMargine = 'N5';
    const InversioneContabile = 'N6.9'; //altri
    const IvaAssoltaUe = 'N7';

    protected static $codifiche = array(
        'N1' => 'escluse ex art. 15',
        'N2.1' => 'non soggette artt 7 - 7septies',
        'N3.4' => 'non imponibili assimilate a cessioni per esportazione',
        'N4' => 'esenti',
        'N5' => 'regime del margine / IVA non esposta in fattura',
        'N6.9' => 'inversione contabile - altri casi',
        'N7' => 'IVA assolta in altro stato UE (vendite a distanza ex art. 40 c. 3 e 4 e art. 
        41 c. 1 lett. b,  DL 331/93; prestazione di servizi di telecomunicazioni, tele-radiodiffusione 
        ed elettronici ex art. 7-sexies lett. f, g, art. 74-sexies DPR 633/72)'
    );
}

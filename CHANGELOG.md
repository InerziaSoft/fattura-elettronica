# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [unreleased]
### Added
- Aggiunto metodo per verifica fattura con schema xsd dell'sdi

### Fixed
- Riga fattura senza quantità

## [1.1.0]
### Added
- Righe fattura con aliquota diversa
- Possibilità di aggiungere la Natura nelle righe con importi non imponibili
- Possibilità di aggiungere la Natura nel blocco DatiRiepilogo
- DatiRiepilogo multipli
- Trait MagicFieldsTrait per aggiunta di campi dinamici in blocco o singolarmente dove la sequenza è determinante

## [1.0.7]
### Fixed
- bug fix

## [1.0.6]
### Added
- Possibilità di aggiungere nell'header i blocchi 'TerzoIntermediarioOSoggettoEmittente' e 'SoggettoEmittente' 
- IntermediarioInterface.php - interfaccia da implementare per l'aggiunta del terzo intermediario

## [1.0.5] - 2018-12-10
### Fixed
- fix Codice Fiscale nel campo idTrasmittente->idCodice utilizzando FatturaElettronicaFactory

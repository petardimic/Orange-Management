<?php
namespace phpOMS\DataStorage\Database\Schema;

interface GrammarInterface
{
    public function typeTinyInt($places);
    public function typeSmallInt($places);
    public function typeMediumInt($places);
    public function typeInt($places);
    public function typeBigInt($places);
    public function typeFloat($m, $e, $b = 10);
    public function typeDouble($m, $e, $b = 10);
    public function typeDecimal($a, $b);
    public function typeBoolean();
    public function typeJson();
    public function typeDate();
    public function typeTime();
    public function typeDateTime();
    public function typeTimestamp();
    public function typeBinary();
    public function typeChar();
    public function typeString();
    public function typeMediumText();
    public function typeText();
    public function typeLongText();
}
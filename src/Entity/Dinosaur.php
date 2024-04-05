<?php

namespace App\Entity;

use App\Enum\SaludStatusEnum;

class Dinosaur
{
    private string $name;
    private string $genus;
    private int $length;
    private string $enclosure;

    private SaludStatusEnum $salud = SaludStatusEnum::SALUDABLE ;

    public function __construct(string $name, string $genus = 'Unknown', int $length = 0, string $enclosure = 'Unknown')
    {
        $this->name = $name;
        $this->genus = $genus;
        $this->length = $length;
        $this->enclosure = $enclosure;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGenus(): string
    {
        return $this->genus;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getEnclosure(): string
    {
        return $this->enclosure;
    }

    public function getSizeDescription():string
    {
        if($this->length >=10){
            return 'Grande';
        }
        if($this->length >= 5){
            return 'Mediano';
        }
//        if($this->length < 10){
//            return 'Mediano';
//        }
        return 'Chico';

    }

    public function isAceptaVisitas():bool
    {
        return $this->salud !== SaludStatusEnum::ENFERMO;
    }

    public function setSalud(SaludStatusEnum $salud):void
    {

        $this->salud = $salud;
    }
}

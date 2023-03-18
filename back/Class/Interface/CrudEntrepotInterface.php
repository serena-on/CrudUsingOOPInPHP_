<?php

namespace Class\Interface;

interface CrudEntrepotInterface
{
    public function getEntrepots();
    public function getEntrepot(string $CodEntrepIn);
    public function createEntrepot(string $CodEntrepIn, string $LibEntrepIn, string $AdrEntrepIn, string $CodLocaIn);
    public function updateEntrepot(string $CodEntrepOut, string $CodEntrepIn, string $LibEntrepIn, string $AdrEntrepIn, string $CodLocaIn);
    public function deleteEntrepot(string $CodEntrepIn);
    public function getCodEntrep() :string;
    public function getLibEntrep() :string;
    public function getAdrEntrep() :string;
    public function getCodLoca() :string;
}
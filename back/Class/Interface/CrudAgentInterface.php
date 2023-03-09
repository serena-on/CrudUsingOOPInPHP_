<?php

namespace Class\Interface;

interface CrudAgentInterface
{
    public function getAgents();
    public function getAgent(string $PrenomAgentIn);
    public function createAgent(string $NomAgentIn, string $PrenomAgentIn, string $DateNaisIn, string $DatePSceIn, string $passwordIn);
    public function updateAgent(string $NomAgentIn, string $PrenomAgentIn, string $DateNaisIn, string $DatePSceIn, string $passwordIn);
    public function deleteAgent(int $idIn);
    public function getNumMatr() :int;
    public function getNomAgent() :string;
    public function getPrenomAgent() :string;
    public function getDateNais() :string;
    public function getDatePSce() :string;
    public function getpassword() :string;
}
<?php

namespace App\Interfaces;

interface PetStoreInterface
{
    public function addPet(array $data);
    public function getPet(int $id);
    public function updatePet(array $data, int $id);
    public function deletePet(int $id);
}
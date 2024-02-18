<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;

interface SupportRepositoryInterface {
    public function paginate(int $page = 1, int $totalPerPag = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): \stdClass|null;
    public function delete(string $id): void;
    public function new(CreateSupportDTO $DTO): \stdClass;
    public function update(UpdateSupportDTO $DTO): \stdClass|null;
}





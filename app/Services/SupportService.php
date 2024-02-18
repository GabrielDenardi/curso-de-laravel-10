<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use App\Repositories\SupportEloquentORM;

class SupportService
{

    public function __construct(
        protected SupportRepositoryInterface $repository
    ){}
    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function paginate(
        int $page = 1,
        int $totalPerPag = 15,
        string $filter = null
    ) {
        return $this->repository->paginate(
            page:$page,
            totalPerPag: $totalPerPag,
            filter: $filter,
        );
    }

    public function findOne(string $id): \stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function new(CreateSupportDTO $DTO): \stdClass
    {
        return $this->repository->new($DTO);
    }

    public function update(UpdateSupportDTO $DTO): \stdClass | null
    {
        return $this->repository->update($DTO);
    }
}

?>

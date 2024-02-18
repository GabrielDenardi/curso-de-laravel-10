<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use function Laravel\Prompts\select;

class SupportEloquentORM implements SupportRepositoryInterface {

    public function __construct(
       protected Support $model
    ) {}

    public function paginate(int $page = 1, int $totalPerPag = 15, string $filter = null): PaginationInterface
    {

        $result = $this->model
            ->where(function ($query) use ($filter){
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->paginate($totalPerPag, ['*'], 'page', $page);
        dd((new PaginationPresenter($result))->items());

        return new PaginationPresenter($result);
    }


    public function getAll(string $filter = null): array
    {

        return $this->model
                        ->where(function ($query) use ($filter){
                            if ($filter) {
                                $query->where('subject', $filter);
                                $query->orWhere('body', 'like', "%{$filter}%");
                            }
                        })
                        ->get()
                        ->toArray();
    }
    public function findOne(string $id): \stdClass|null
    {
        $support = $this->model->find($id);
        if(!$support) {
            return null;
        }

        return (object) $support->toArray();
    }
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
    public function new(CreateSupportDTO $DTO): \stdClass
    {
        $support = $this->model->create(
            (array) $DTO
        );

        return (object) $support->toArray();
    }
    public function update(UpdateSupportDTO $DTO): \stdClass|null
    {
        if (!$support = $this->model->find($DTO->id)){
            return null;
        }

        $support->update(
            (array) $DTO
        );

        return (object) $support->toArray();
    }
}




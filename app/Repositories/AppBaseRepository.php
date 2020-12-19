<?php


namespace App\Repositories;


use App\Traits\Errors;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class AppBaseRepository extends BaseRepository
{
    use Errors;

    public function model()
    {
        // TODO: Implement model() method.
    }
}

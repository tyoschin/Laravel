<?php
/**
 * Description of CountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class EloquentCountryRepository implements CountryRepositoryInterface
{

    public function find(int $id)
    {
        return Country::find($id);
    }

    /**
     * @param array $filters
     * @param array $with
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function getBy(array $filters = [], array $with = [])
    {
        return Country::with($with)->get();
    }

    /**
     * @param array $filters
     * @param array $with
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function search(array $filters = [], array $with = [])
    {
        return Country::with($with)->paginate();
    }

    public function createFromArray(array $data): Country
    {
        $country = new Country();
        $country->create($data);
        return $country;
    }

    public function updateFromArray(Country $country, array $data)
    {
        $country->update($data);
        return $country;
    }

}
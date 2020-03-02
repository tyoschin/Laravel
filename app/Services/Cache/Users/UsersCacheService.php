<?php


namespace App\Services\Cache\Users;


use App\Services\Cache\CacheConstants;
use Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

/**
 * Class UsersCacheService
 * @package App\Services\Cache\Users
 */
class UsersCacheService
{
    /**
     * @return bool|mixed
     */
    public function getUserListFromCache()
    {
        $uri = Request::fullUrl();
        $key = md5($uri);
        if (Cache::tags([CacheConstants::USERS_LIST_TAG, CacheConstants::USER_ENTITY_TAG])->has($key)) {
            return Cache::tags([CacheConstants::USERS_LIST_TAG, CacheConstants::USER_ENTITY_TAG])->get($key);
        }
        return false;
    }

    /**
     * @param string $uri
     * @param LengthAwarePaginator $usersList
     * @return bool
     */
    public function putUsersListToCache(LengthAwarePaginator $usersList)
    {
        $uri = Request::fullUrl();
        $key = md5($uri);
        return Cache::tags([
            CacheConstants::USERS_LIST_TAG,
            CacheConstants::USER_ENTITY_TAG
        ])->put($key, $usersList, CacheConstants::TIME_FOR_USERS_LIST);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function getUserDataFromCache(int $id)
    {
        $key = md5(CacheConstants::USER_KEY_FOR_CACHE.$id);
        if (Cache::tags([CacheConstants::USER_TAG, CacheConstants::USER_ENTITY_TAG])->has($key)) {
            return Cache::tags([CacheConstants::USER_TAG, CacheConstants::USER_ENTITY_TAG])->get($key);
        }
        return false;
    }

    /**
     * @param int $id
     * @param $data
     * @return bool
     */
    public function putUserDataToCache(int $id, $data)
    {
        $key = md5(CacheConstants::USER_KEY_FOR_CACHE.$id);
        return Cache::tags([
            CacheConstants::USER_TAG,
            CacheConstants::USER_ENTITY_TAG
        ])->put($key, $data, CacheConstants::TIME_FOR_USER);
    }
}

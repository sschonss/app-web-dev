<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisService
{
    private Redis $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public static function set(string $key, string $value, int $ttl = 0): void
    {
        Redis::set($key, $value);
        if ($ttl) {
            Redis::expire($key, $ttl);
        }
    }

    public static function get(string $key)
    {
        return Redis::get($key);
    }

    public static function delete(string $key): void
    {
        Redis::del($key);
    }

    public static function exists(string $key): bool
    {
        return Redis::exists($key);
    }

    public static function flushAll(): void
    {
        Redis::flushAll();
    }

}

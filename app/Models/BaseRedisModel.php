<?php

namespace App\Models;

use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseRedisModel
{
    /**
     * @var int
     */
    protected int $id;

    /**
     *
     * @return bool
     */
    public function save(): bool
    {
        return Redis::connection()->client()->set(
            $this->getKey($this->id),
            self::serialize($this)
        );
    }

    /**
     *
     * @param string $id
     * @return BaseRedisModel|null
     */
    public static function find(int $id): ?BaseRedisModel
    {
        $key = self::getKey($id);
        if ($value = Redis::connection()->client()->get($key)) {
            return self::unserialize($value);
        }

        return null;
    }


    /**
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     *
     * @param string $id
     * @return BaseRedisModel
     */
    public static function findOrFail(int $id): BaseRedisModel
    {
        if (!$model = self::find($id)) {
            throw new NotFoundHttpException(
                get_called_class() . ' not found with ' . $id
            );
        }

        return $model;
    }

    /**
     *
     * @param int $id
     * @return string
     */
    protected static function getKey(int $id): string
    {
        return basename(get_called_class()) . ':' . md5($id);
    }

    /**
     *
     * @param mixed $value
     * @return mixed
     */
    protected static function serialize(mixed $value): mixed
    {
        return is_numeric($value) && !in_array($value, [INF, -INF]) && !is_nan($value) ? $value : serialize($value);
    }

    /**
     *
     * @param mixed $value
     * @return mixed
     */
    protected static function unserialize(mixed $value): mixed
    {
        return is_numeric($value) ? $value : unserialize($value);
    }

}

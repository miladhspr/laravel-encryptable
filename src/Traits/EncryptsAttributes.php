<?php
namespace MiladHspr\Encryptable\Traits;

use MiladHspr\Encryptable\Helpers\EncryptHelper;
use Illuminate\Database\Eloquent\Builder;

trait EncryptsAttributes
{
    protected static function bootEncryptsAttributes()
    {
        static::addGlobalScope('encrypt', function (Builder $builder) {
            foreach ((new static)->encryptable ?? [] as $column) {
                $builder->macro('where', function ($builder, $column, $operator = null, $value = null, $boolean = 'and') {
                    if (in_array($column, (new static)->encryptable ?? []) && is_string($value)) {
                        $value = EncryptHelper::encrypt($value);
                    }
                    return $builder->whereRaw("$column = ?", [$value]);
                });
            }
        });
    }

    public function setAttribute($key, $value)
    {
        if ($this->shouldEncrypt($key)) {
            $value = EncryptHelper::encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        return $this->shouldEncrypt($key) ? EncryptHelper::decrypt($value) : $value;
    }

    public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->encryptable ?? [] as $key) {
            if (isset($array[$key])) {
                $array[$key] = EncryptHelper::decrypt($array[$key]);
            }
        }
        return $array;
    }

    private function shouldEncrypt($key)
    {
        return config('encryptable.enabled') &&
            in_array($key, $this->encryptable ?? []);
    }
}

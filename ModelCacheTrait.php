<?php

namespace yegorus\treegrid;

/**
 * Кешер данных модели
 * Позволяет сократить количество шаблонного кода с добавлением приватных
 * переменых кеша
 */
trait ModelCacheTrait
{

    private $_cache = [];

    /**
     * Получить данные с кешированием
     * @param string $key ключ кеша
     * @param callable $callback коллбэк с кодом получения данных
     * @return mixed данные
     */
    protected function cachedGet($key, $callback)
    {
        // Через isset и null не получится!!! нужно знать есть ли ключ в массиве
        if (!array_key_exists($key, $this->_cache)) {
            $this->_cache[$key] = call_user_func($callback);
        }
        return $this->_cache[$key];
    }
}
<?php
	namespace KrameWork\Caching;

	require_once(__DIR__ . "/IDataCache.php");

	/**
	 * Class Memcached
	 * Interface layer for Memcached.
	 *
	 * @package KrameWork\Caching
	 * @author Kruithne (kruithne@gmail.com)
	 */
	class Memcached implements IDataCache
	{
		/**
		 * Memcached constructor.
		 *
		 * @api
		 * @param string $server Memcached server address.
		 * @param int $port Memcached server port.
		 */
		public function __construct(string $server = "127.0.0.1", int $port = 11211) {
			$this->cache = new \Memcached;
			$this->cache->addServer($server, $port);
		}

		/**
		 * Obtain a value from the cache.
		 *
		 * @api
		 * @param string $key Key of the value.
		 * @return mixed|null Value, or null if not found.
		 */
		public function __get(string $key) {
			$value = $this->cache->get($key);
			if ($this->cache->getResultCode() == \Memcached::RES_NOTFOUND)
				return null;

			return $value;
		}

		/**
		 * Store a value in the cache.
		 * Value will not expire. Use store() if needed.
		 *
		 * @api
		 * @param string $key Key to store the value under.
		 * @param mixed $value Value to store in the cache.
		 * @param int $expire Expiry time as Unix timestamp, 0 = never.
		 */
		public function store(string $key, $value, int $expire = 0): void {
			$this->cache->set($key, $value, $expire);
		}

		/**
		 * Check if a value exists in the cache.
		 *
		 * @param string $key Key used to store the value.
		 * @return bool True if the key exists in the cache.
		 */
		public function exists(string $key): bool
		{
			$this->cache->get($key);
			return $this->cache->getResultCode() != \Memcached::RES_NOTFOUND;
		}

		/**
		 * Store a value in the cache.
		 *
		 * @api
		 * @param string $key Key to store the value under.
		 * @param mixed $value Value to store in the cache.
		 */
		public function __set(string $key, $value): void {
			$this->store($key, $value);
		}

		/**
		 * Remove an item stored in the cache.
		 *
		 * @api
		 * @param string $key Key of the item to remove.
		 */
		public function __unset(string $key): void {
			$this->cache->delete($key);
		}

		/**
		 * Flush the cache, removing all stored data.
		 *
		 * @api
		 */
		public function flush(): void {
			$this->cache->flush();
		}

		/**
		 * Increase a numeric value in the cache.
		 *
		 * @param string $key Key of the value.
		 * @param int $weight How much to increment the value.
		 */
		public function increment(string $key, int $weight): void {
			$this->cache->increment($key, $weight);
		}

		/**
		 * Decrease a numeric value in the cache.
		 *
		 * @param string $key Key of the value.
		 * @param int $weight How much to decrement the value.
		 */
		public function decrement(string $key, int $weight) {
			$this->cache->decrement($key, $weight);
		}

		/**
		 * @var \Memcached
		 */
		private $cache;
	}
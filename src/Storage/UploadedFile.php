<?php
	namespace KrameWork\Storage;

	require_once(__DIR__ . "/File.php");

	class UploadedFile extends File
	{
		/**
		 * UploadedFile constructor.
		 * @param string $path Temporary location.
		 * @param string $name Uploaded name.
		 * @param int $errorCode
		 */
		public function __construct(string $path, string $name, int $errorCode) {
			parent::__construct($path, false, false);
			$this->name = $name;
			$this->errorCode = $errorCode;
		}

		/**
		 * Error code for the upload.
		 * @return int
		 */
		public function getErrorCode():int {
			return $this->errorCode;
		}

		/**
		 * @var int
		 */
		protected $errorCode;
	}
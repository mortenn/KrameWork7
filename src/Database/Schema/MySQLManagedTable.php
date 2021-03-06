<?php
	/*
	* Copyright (c) 2017 Morten Nilsen (morten@runsafe.no)
	* https://github.com/Kruithne/KrameWork7
	*
	* Permission is hereby granted, free of charge, to any person obtaining a copy
	* of this software and associated documentation files (the "Software"), to deal
	* in the Software without restriction, including without limitation the rights
	* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	* copies of the Software, and to permit persons to whom the Software is
	* furnished to do so, subject to the following conditions:
	*
	* The above copyright notice and this permission notice shall be included in all
	* copies or substantial portions of the Software.
	*
	* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	* SOFTWARE.
	*/

	namespace KrameWork\Database\Schema;

	require_once(__DIR__ . '/ManagedTable.php');
	require_once(__DIR__ . '/../Driver/Generic.php');

	/**
	 * Class to handle a managed table hosted by a MySQL Server
	 * @author docpify <morten@runsafe.no>
	 * @package KrameWork\Database
	 */
	abstract class MySQLManagedTable extends ManagedTable
	{
		/**
		 * @api GetSchema
		 * Returns the name of the database schema
		 * @return string The database schema name
		 */
		public function getSchema() {
			return '';
		}

		/**
		 * @api GetFullName
		 * Returns the fully qualified table name, including schema.
		 * @return string Fully qualified table name
		 */
		public function getFullName() {
			return $this->quoteIdentifier($this->getName());
		}

		public function quoteIdentifier($identifier)
		{
			return "`{$identifier}`";
		}
	}

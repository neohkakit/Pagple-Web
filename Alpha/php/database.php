<?php
	/**
	 * Interface for class Database. Add or alter the functions here accordingly.
	*/
	interface DatabaseTemplate {
		// public function
		public function connect();
		public function close();
		public function execute($query);
	}
	
	/**
	 * PHP mysql API is deprecated. I had revised my code on using mysqli API (MySQL Improved Extension).
	 * Make sure your PHP version is up-to-date. Recommended version 5.2 or above.
	 * read the DOC for more information: http://php.net/manual/en/mysqli.overview.php
	 *
	 * All Rights Reserved
	 *
	 * Lim Teik Wei @ d4vid.tw89@gmail.com
	 * Ryne Cheow @ rynec92@hotmail.com
	*/
	class Database implements DatabaseTemplate
	{
		// private attributes
		private $user;
		private $password;  
		private $database; // database name
		private $host;     // database host
		private $con;      // database connection
		private $tid;      // thread id		
		private $result;   // result retrieve from table
		private $connected = FALSE; // check database connection
		
		// constructor
		public function __construct() {
			$this->host      = 'localhost';
			$this->user      = 'pagpleco_admin';
			$this->password  = 'Passple__88';
			$this->database  = 'pagpleco_subscriber';
		}
		
		// destructor
		function __destruct() {
			// auto garbage collected, perform something only if necessary
		}
		
		// connect to mysql
		public function connect() {	
			// connect only if not connected
			if (!$this->connected) {
				$this->con = new mysqli($this->host, $this->user , $this->password, $this->database);			
				
				// connect_errno only works on php 5.3 or above, use php connect_error if below.
				if ($this->con->connect_errno) {
					// echo 'Couldn\'t connect database (Error ' . $this->con->connect_errno . '): ' . $this->con->connect_error();
					exit();
				}
				
				// connection thread id
				$this->tid = $this->con->thread_id;
				
				// assign TRUE if connected, else FALSE
				$this->connected = $this->con->ping()? TRUE : FALSE;				
			} else {
				// connected, do nothing
			}
		}
		
		// close database connection
		public function close() {
			if ($this->connected) {
				// kill the connection thread before closing connection
				$this->con->kill($this->con->thread_id);
				$this->con->close();
				$this->connected = FALSE;
			} else {
				// connection closed or not connected
			}
		}
		
		// execute query
		public function execute($query) {
			if ($this->connected) {
				if (!($this->result = $this->con->query($query, MYSQLI_USE_RESULT))) {
					return NULL;	
				}
			} else {
				// no connection to database.
				return NULL;
			}
			return $this->result;
		}
		
		// print mysql statement error message
		private function print_err($statement, $errmsg) {
			echo $errmsg . ' (' . $statement->errno . '): ' . $statement->error;
		}
		
		/**
		 * Temporary section
		 * : Remove function accordingly if not part of the development
		*/
		
		// inserting email using mysqli_prepare
		public function temp_execute($query, $email) {
			if ($this->connected) {
				if ($statement = $this->con->prepare($query)) {
					if (!$statement->bind_param('s', $email)) {
						// print_err($statement, 'Binding parameter failed');
						return FALSE;
					}					
					if(!$statement->execute()) {
						// print_err($statement, 'Execution failed');
						return FALSE;
					}
					$statement->close();
				} else {
					// query error
					return FALSE;
				}
			} else {
				// no connection to database.
				return FALSE;
			}
			return TRUE;
		}
	} // end class
?>
















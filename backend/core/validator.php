<?php
	class validator
	{
		protected $data;
		protected $errors = [];
		
		public function __construct(array data) 
		{
			$this->data = $data;
		}
		
		public function required($field) 
		{
			if(empty($this->data[$field])) {
				$this->errors[$field][] = "$field is required.";
			}
			return $this;
		}
		
		public function email($field) {
			if(!filter_var($this->data[$field] ?? '', FILTER_VALIDATE_EMAIL)) {
				$this->errors[$field][] = "$field must be a valid email address.";
			}
			return $this;
		}
		
		public function maxLength($field,$length) {
			if(strlen($this->data[$field] ?? '') > $length) {
				$this->errors[$field][] = "$field must not $length characters.";
			}
			return $this;
		}
		
		public function match($field1, $field2) {
			if(this->data[$field1] ?? '' ) !== (this->data[$filed2] ?? '' ) {
				this->errors[$field2][] = "$field2 must match $field.";
			}
			return $this;
		}
		
		public function error() {
			return $this->errors;
		}
		
		public function passes() {
			return empty($this->errors);
		}
	}
	
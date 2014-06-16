<?php
	class random_string extends random{
		const ENCODE = 'UTF-8';
	
		const NUMERIC = '0123456789';
		const UPPERCASE = 'qwertzuiopasdfghjklyxcvbnm';
		const LOWERCASE = 'QWERTZUIOPASDFGHJKLYXCVBNM';
	
		public function random_stringX(){
			
		}
	
		public function setString($string){
			$result = $this->string;
			{
				$this->string = $string;
			}
			return $result;
		}
	
		public function getString($numeric = true, $lowercase = true, $uppercase = false, $string = "", $encode = self::ENCODE){
			$result = "";
			{
				$result_tmp = array();
				{
					{
						$string = self::string_build($numeric, $lowercase, $uppercase, $string);
						if(!empty($string)){
							$string_length = mb_strlen($string, $encode);
							for($i = 0; $i < $string_length; $i++){
								$char = mb_substr($string, $i, 1, $encode);
								if(!isset($result_tmp[$char])){
									$result_tmp[$char] = '';
								}
							}
						}
					}
					$result = implode("", array_keys($result_tmp));
				}
			}
			return $result;
		}
	
		private static function string_build($numeric = true, $lowercase = true, $uppercase = false, $string = ""){
			$result = $string;
			if($numeric){
				$result .= self::NUMERIC;
			}
			if($lowercase){
				$result .= self::UPPERCASE;
			}
			if($uppercase){
				$result .= self::LOWERCASE;
			}
			return $result;
		}
	
		public function getParameter(){
			static $result = array(
					'encode' => array(
							'type' => 'select',
							'default' => self::ENCODE,
							'list' => array()
						),
					'numeric' => array(
							'type' => 'boolean',
							'default' => true
						),
					'lowercase' => array(
							'type' => 'boolean',
							'default' => true
						),
					'uppercase' => array(
							'type' => 'boolean',
							'default' => false
						),
					'string' => array(
							'type' => 'string',
							'default' => ""
						),
					'length' => array(
							'type' => 'numeric',
							'default' => 10,
							'min' => 0,
							'max' => 128
						)
				);
			if(empty($result['encode']['list'])){
				foreach(mb_list_encodings() as $encoding){
					$result['encode']['list'][strtoupper($encoding)] = $encoding; 
				}
			}
			return $result;
		}
		
		public function generate($parameter = null){
			$result = "";
			{
				$parameter_default = $this->getParameter();
				{
					$parameter_execute = array(
							'encode' => $parameter_default['encode']['default'],
							'numeric' => $parameter_default['numeric']['default'],
							'lowercase' => $parameter_default['lowercase']['default'],
							'uppercase' => $parameter_default['uppercase']['default'],
							'string' => $parameter_default['string']['default'],
							'length' => $parameter_default['length']['default']
						);
					{
						if(is_array($parameter)){
							if(array_key_exists('encode', $parameter) && array_key_exists($parameter['encode'], $parameter_default['encode']['list'])){
								$parameter_execute['encode'] = $parameter['encode'];
							}
							
							if(array_key_exists('numeric', $parameter)){
								$parameter_execute['numeric'] = $parameter['numeric'];
							}
							
							if(array_key_exists('lowercase', $parameter)){
								$parameter_execute['lowercase'] = $parameter['lowercase'];
							}
							
							if(array_key_exists('uppercase', $parameter)){
								$parameter_execute['uppercase'] = $parameter['uppercase'];
							}
							
							if(array_key_exists('string', $parameter)){
								$parameter_execute['string'] = $parameter['string'];
							}
							
							if(array_key_exists('length', $parameter)){
								$parameter_execute['length'] = $parameter['length'];
							}
						}
						
						if(array_key_exists('length', $parameter_default)){
							$parameter_execute['length'] = max($parameter_execute['length'], $parameter_default['length']['min']);
							$parameter_execute['length'] = min($parameter_execute['length'], $parameter_default['length']['max']);
						}
					}
					
					{
						$string = $this->getString($parameter_execute['numeric'], $parameter_execute['lowercase'], $parameter_execute['uppercase'], $parameter_execute['string'], $parameter_execute['encode']);
						if(!empty($string)){
							$string_length = mb_strlen($string, $parameter_execute['encode']) - 1;
							for($i = 0; $i < $parameter_execute['length']; $i++){
								$result .= mb_substr($string, rand(0, $string_length), 1, $parameter_execute['encode']);
							}
						}
					}
				}
			}
			return $result;
		}
	}
?>

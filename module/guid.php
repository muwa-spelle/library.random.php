<?php
	class random_guid extends random{
		const BRANCE_PREFIX = '{';
		const BRANCE_SUFFIX = '}';
		
		const HYPHENS = '-';
		
		const SEGMENT_STRING = '0123456789ABCDEF';
		
		const SEGMENT_LENGTH_1 = 8;
		const SEGMENT_LENGTH_2 = 4;
		const SEGMENT_LENGTH_3 = 4;
		const SEGMENT_LENGTH_4 = 4;
		const SEGMENT_LENGTH_5 = 12;
		
		public function random_guid(){
			
		}
	
		public function getString(){
			$result = self::SEGMENT_STRING;
			{
				
			}
			return $result;
		}
		
		public function getParameter(){
			static $result = array(
					'braces' => array(
							'type' => 'boolean',
							'default' => true
						),
					'hyphens' => array(
							'type' => 'boolean',
							'default' => true
						),
					'lowercase' => array(
							'type' => 'boolean',
							'default' => false
						)
				);
			{
				
			}
			return $result;
		}
		
		public function generate($parameter = null){
			$result = "";
			{
				$parameter_default = $this->getParameter();
				{
					$parameter_execute = array(
							'braces' => $parameter_default['braces']['default'],
							'hyphens' => $parameter_default['hyphens']['default'],
							'lowercase' => $parameter_default['lowercase']['default']
						);
					if(is_array($parameter)){
						if(array_key_exists('braces', $parameter)){
							$parameter_execute['braces'] = $parameter['braces'];
						}
						if(array_key_exists('hyphens', $parameter)){
							$parameter_execute['hyphens'] = $parameter['hyphens'];
						}
						if(array_key_exists('lowercase', $parameter)){
							$parameter_execute['lowercase'] = $parameter['lowercase'];
						}
					}
					
					if($parameter_execute['hyphens']){
						$result .= parent::generate(array('length' => self::SEGMENT_LENGTH_1));
						$result .= self::HYPHENS;
						$result .= parent::generate(array('length' => self::SEGMENT_LENGTH_2));
						$result .= self::HYPHENS;
						$result .= parent::generate(array('length' => self::SEGMENT_LENGTH_3));
						$result .= self::HYPHENS;
						$result .= parent::generate(array('length' => self::SEGMENT_LENGTH_4));
						$result .= self::HYPHENS;
						$result .= parent::generate(array('length' => self::SEGMENT_LENGTH_5));
					}else{
						$result .= parent::generate(array('length' => 
								self::SEGMENT_LENGTH_1 +
								self::SEGMENT_LENGTH_2 +
								self::SEGMENT_LENGTH_3 +
								self::SEGMENT_LENGTH_4 +
								self::SEGMENT_LENGTH_5
							));
					}
					
					if($parameter_execute['lowercase']){
						$result = strtolower($result);
					}
					
					if($parameter_execute['braces']){
						$result = self::BRANCE_PREFIX.$result.self::BRANCE_SUFFIX;
					}
				}
			}
			return $result;
		}
	}

?>
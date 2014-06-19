<?php
	class random_color extends random{
		
		const TYPE_HEX = 'HEX';
		const TYPE_RGB = 'RGB';
		
		const TYPE_HEX_PREFIX = '#';
		const TYPE_RGB_DELIMITER = ', ';
		
		const DECIMAL_MIN = 0;
		const DECIMAL_MAX = 255;
		
		const FILL_LENGTH = "0";
	
		public function random_color(){
	
		}
	
		public function getParameter(){
			static $result = array(
					'type' => array(
							'type' => 'select',
							'default' => self::TYPE_HEX,
							'list' => array(
									self::TYPE_HEX => self::TYPE_HEX,
									self::TYPE_RGB => self::TYPE_RGB,
								)
						)
				);
			{
				
			}
			return $result;
		}
	
		public function getString(){
			$result = null;
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
							'type' => $parameter_default['type']['default']
						);
					
					if(is_array($parameter)){
						if(array_key_exists('type', $parameter)){
							$parameter_execute['type'] = $parameter['type'];
						}
					}
					
					{
						$tmp = array(
								rand(self::DECIMAL_MIN, self::DECIMAL_MAX),
								rand(self::DECIMAL_MIN, self::DECIMAL_MAX),
								rand(self::DECIMAL_MIN, self::DECIMAL_MAX),
							);
						
						if($parameter_execute['type'] == self::TYPE_RGB){
							$result = implode(self::TYPE_RGB_DELIMITER, $tmp);
						}else{
							$result = self::TYPE_HEX_PREFIX;
							foreach($tmp as $value){
								$result .= strtoupper(str_pad(dechex($value), 2, self::FILL_LENGTH, STR_PAD_LEFT)); 
							}
						}
					}
				}
			}
			return $result;
		}
	}
?>
<?php
	class random_numeric extends random{
	
		const TYPE_DECIMAL = "decimal";
		const TYPE_HEXADECIMAL = "hexadecimal";
		const TYPE_BINARY = "binary";
		const TYPE_OCTAL = "octal";
		
		public function random_numeric(){
				
		}
		
		public function getParameter(){
			static $result = array(
					'type' => array(
							'type' => 'select',
							'default' => self::TYPE_DECIMAL,
							'list' => array(
									self::TYPE_DECIMAL => self::TYPE_DECIMAL,
									self::TYPE_HEXADECIMAL => self::TYPE_HEXADECIMAL,
									self::TYPE_BINARY => self::TYPE_BINARY,
									self::TYPE_OCTAL => self::TYPE_OCTAL
								)
						),
					'from' => array(
							'type' => 'numeric',
							'default' => 0,
							'min' => 0,
							'max' => null
						),
					'to' => array(
							'type' => 'numeric',
							'default' => 1000,
							'min' => 0,
							'max' => null
						)
				);
			{
				if(empty($result['from']['max'])){
					$result['from']['max'] = getrandmax();
				}
				if(empty($result['to']['max'])){
					$result['to']['max'] = getrandmax();
				}
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
			$result = 0;
			{
				$parameter_default = $this->getParameter();
				{
					$parameter_execute = array(
							'type' => $parameter_default['type']['default'],
							'from' => $parameter_default['from']['default'],
							'to' => $parameter_default['to']['default']
						);
					{
						if(is_array($parameter)){
							if(array_key_exists('type', $parameter)){
								$parameter_execute['type'] = $parameter['type'];
							}
							if(array_key_exists('from', $parameter)){
								$parameter_execute['from'] = intval($parameter['from']);
							}
							if(array_key_exists('to', $parameter)){
								$parameter_execute['to'] = intval($parameter['to']);
							}
						}
						
						{
							$tmp = array(
									'from' => min($parameter_execute['from'], $parameter_execute['to']),
									'to' => max($parameter_execute['from'], $parameter_execute['to'])
								);
							{
								$parameter_execute['from'] = $tmp['from'];
								$parameter_execute['to'] = $tmp['to'];
							}
						}
					}
					
					{
						$result = rand($parameter_execute['from'], $parameter_execute['to']);
						if($parameter_execute['type'] == self::TYPE_HEXADECIMAL){
							$result = strtoupper(dechex($result));
						}else if($parameter_execute['type'] == self::TYPE_BINARY){
							$result = decbin($result);
						}else if($parameter_execute['type'] == self::TYPE_OCTAL){
							$result = decoct($result);
						}
					}
				}
			}
			return $result;
		}
	}
?>
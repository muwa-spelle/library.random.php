<?php
	abstract class random{
		const MODULE_DIRECTORY = 'module';
		const MODULE_CLASS_SEPARATOR = '_';
		
		abstract public function getString();
		
		public function getParameter(){
			static $result = array(
					'length' => array(
							'type' => 'numeric',
							'default' => 8,
							'min' => 0,
							'max' => 32
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
							'length' => $parameter_default['length']['default']
						);
					{
						if(is_array($parameter) && array_key_exists('length', $parameter)){
							$parameter_execute['length'] = $parameter['length'];
						}
						
						if(array_key_exists('length', $parameter_default)){
							$parameter_execute['length'] = max($parameter_execute['length'], $parameter_default['length']['min']);
							$parameter_execute['length'] = min($parameter_execute['length'], $parameter_default['length']['max']);
						}
					}
					
					{
						$string = $this->getString();
						{
							$string_length = strlen($string) - 1;
							for($i = 0; $i < $parameter_execute['length']; $i++){
								$result .= $string[rand(0, $string_length)];
							}
						}
					}
				}
			}
			return $result;
		}
		
		private static function path_info(){
			static $result = null;
			if(is_null($result)){
				$result = pathinfo(__FILE__);
			}
			return $result;
		}
		
		public static function build($module, $arguments = array()){
			$result = null;
			{
				$path_parts = self::path_info();
				{
					$directory = $path_parts['dirname'].DIRECTORY_SEPARATOR.self::MODULE_DIRECTORY.DIRECTORY_SEPARATOR;
					if(file_exists($file = $directory.$module.'.'.$path_parts['extension'])){
						require_once $file;
						if(class_exists($class = $path_parts['filename'].self::MODULE_CLASS_SEPARATOR.$module)){
							@call_user_func_array(array($result = new $class(), $class), $arguments);
						}
					}
				}
			}
			return $result;
		}
		
		public static function list_module(){
			$result = array();
			{
				$path_parts = self::path_info();
				{
					$directory = $path_parts['dirname'].DIRECTORY_SEPARATOR.self::MODULE_DIRECTORY.DIRECTORY_SEPARATOR;
					if(@$handle = opendir($directory)){
						$extension = strrev($path_parts['extension']).'.';
						while($file = readdir($handle)){
							if(strripos(strrev($file), $extension) === 0){
								array_push($result, substr($file, 0, strlen($extension)*-1));
							}
						}
					}
				}
			}
			return $result;
		}
	}
?>
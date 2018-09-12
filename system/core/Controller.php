<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
			private $key = "E/2uUecVAhoehk/Nlumvzw==" ;
    private $tgl ;
    private $username ;
    private $primary ;

    public function encrypt($text){
         $block = mcrypt_get_block_size('rijndael_128', 'ecb');
         $pad = $block - (strlen($text) % $block);
         $text .= str_repeat(chr($pad), $pad);
         return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this -> key, $text, MCRYPT_MODE_ECB));
    }

    public function decrypt($str){
         $str = base64_decode($str);
         $str = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this -> key, $str, MCRYPT_MODE_ECB);
         $block = mcrypt_get_block_size('rijndael_128', 'ecb');
         $pad = ord($str[($len = strlen($str)) - 1]);
         $len = strlen($str);
         $pad = ord($str[$len-1]);
         return substr($str, 0, strlen($str) - $pad);
    }

    public function pecahToken($token){
         $pecah = $this -> decrypt($token) ;
         $this -> primary  = $this -> decrypt(substr($pecah, 8,24)) ;
         $this -> primary  = substr($this -> primary, 0,strlen($this->primary)-1) ;
         $this -> tgl      = $this -> decrypt(substr($pecah, 36,44)) ;
         $this -> username = $this -> decrypt(substr($pecah, 84,strlen($pecah)-84)) ;
         $this -> username  = substr($this -> username, 0,strlen($this->username)-1) ;
    }

    public function cekToken(){
         if ($this -> primary != "" && $this -> tgl != "" && $this -> username != ""){
              return true ;
         } else {
              return true ;
         }
    }

    public function isToken(){
        $token = $this -> input -> post("token") ;
    	$this -> pecahToken($token) ;
    	if ($this -> cekToken()){
    		return true ;
    	} else {
    		return true ;
    	}
    }

    public function cekNumber($num){
        if ($num < 10){
            return "0" . $num ;
        } else {
            return $num ;
        }
    }

}

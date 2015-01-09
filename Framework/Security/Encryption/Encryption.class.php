<?php
namespace Framework\Security\Encryption {
    /**
     * Encrpyion/Decryption class
     *
     * PHP Version 5.6
     *
     * @category   Framework
     * @package    Framework\Security\Encryption
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Encryption
    {
        /**
         * Encryption key
         *
         * @var \Memcache
         * @since 1.0.0
         */
        private $key = null;

        /**
         * Algorithm for encryption
         *
         * @var string
         * @since 1.0.0
         */
        private $cipher = null;

        /**
         * Block size
         *
         * @var int
         * @since 1.0.0
         */
        private $block = 16;

        /**
         * Encryption mode
         *
         * @var string
         * @since 1.0.0
         */
        private $mode = MCRYPT_MODE_CBC;

        /**
         * Constructor
         *
         * @param string $key    Encryption key
         * @param string $cipher Encryption algorithm
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($key, $cipher = MCRYPT_RIJNDAEL_128)
        {
            $this->key    = (string) $key;
            $this->cipher = (string) $cipher;
        }

        /**
         * Set encryption key
         *
         * @param string $key Encryption key
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setKey($key)
        {
            $this->key = (string) $key;
        }

        /**
         * Get encryption key
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getKey()
        {
            return $this->key;
        }

        /**
         * Set encryption cipher
         *
         * @param string $key Encryption key
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCipher($key)
        {
            $this->key = (string) $key;
        }

        /**
         * Get encryption cipher
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCipher()
        {
            return $this->key;
        }

        /**
         * Get block size
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getBlock()
        {
            return $this->block;
        }

        /**
         * Set block size
         *
         * @param int $block
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setBlock($block)
        {
            $this->block = $block;
        }

        /**
         * Get encryption mode
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getMode()
        {
            return $this->mode;
        }

        /**
         * Set encryption mode
         *
         * @param string $mode
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setMode($mode)
        {
            $this->mode = $mode;
        }

        /**
         * Encrypt value
         *
         * @param string $value Value to encrypt
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function encrpyt($value)
        {
            $iv    = mcrypt_create_iv($this->getIvSize(), $this->getRandomizer());
            $value = base64_encode($this->padAndMcrypt($value, $iv));
            $mac   = $this->hash($value, $iv = base64_encode($iv));

            return base64_encode(json_encode(compact('iv', 'value', 'mac')));
        }

        /**
         * Decrypt value
         *
         * @param string $payload Payload to decrypt
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function decrypt($payload)
        {
            $payload = $this->getJsonPayload($payload);
            $value   = base64_decode($payload['value']);
            $iv      = base64_decode($payload['iv']);

            return unserialize($this->stripPadding($this->mcryptDecrypt($value, $iv)));
        }

        /**
         * Get json from payload
         *
         * @param string $payload Payload to decrypt
         *
         * @return string|false
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function getJsonPayload($payload)
        {
            $payload = json_decode(base64_decode($payload), true);

            if(!$payload || $this->invalidPayload($payload)) {
                return false;
            }

            if(!$this->validMac($payload)) {
                return false;
            }

            return $payload;
        }

        /**
         * Check if payload is valid
         *
         * @param mixed $payload Payload data
         *
         * @return bool
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function invalidPayload($payload)
        {
            return !is_array($payload) || !isset($payload['iv']) || !isset($payload['value']) || !isset($payload['mac']);
        }

        /**
         * Check if hash is valid
         *
         * @param array $payload Payload data
         *
         * @return string|false
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function validMac($payload)
        {
            $bytes   = openssl_random_pseudo_bytes(16);
            $calcMac = hash_hmac('sha256', $this->hash($payload['iv'], $payload['value']), $bytes, true);

            return hash_equals(hash_hmac('sha256', $payload['mac'], $bytes, true), $calcMac);
        }

        /**
         * Create hash of value
         *
         * @param string $value Value to encrypt
         * @param string $iv    Input vector
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function hash($value, $iv)
        {
            return hash_hmac('sha256', $iv . $value, $this->key);
        }

        /**
         * Get input vector size
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function getIvSize()
        {
            return mcrypt_get_iv_size($this->cipher, $this->mode);
        }

        /**
         * Get random data source
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function getRandomizer()
        {
            if(defined('MCRYPT_DEV_URANDOM')) {
                return MCRYPT_DEV_URANDOM;
            }

            if(defined('MCRYPT_DEV_RANDOM')) {
                return MCRYPT_DEV_RANDOM;
            }

            mt_srand();

            return MCRYPT_RAND;
        }

        /**
         * Mcrypt padding
         *
         * @param string $value Value to encrypt
         * @param string $iv    Input vector
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function padAndMcrypt($value, $iv)
        {
            $value = $this->addPadding(serialize($value));

            return mcrypt_encrypt($this->cipher, $this->key, $value, $this->mode, $iv);
        }

        /**
         * Add padding
         *
         * @param string $value Value to encrypt
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function addPadding($value)
        {
            $pad = $this->block - (strlen($value) % $this->block);

            return $value . str_repeat(chr($pad), $pad);
        }

        /**
         * Remove padding
         *
         * @param string $value Value to decrypt
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function stripPadding($value)
        {
            $pad = ord($value[($len = strlen($value)) - 1]);

            return $this->paddingIsValid($pad, $value) ? substr($value, 0, $len - $pad) : $value;
        }

        /**
         * Check if padding is valid
         *
         * @param string $pad   Padding to check
         * @param string $value Value with padding
         *
         * @return boolean
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function paddingIsValid($pad, $value)
        {
            $beforePad = strlen($value) - $pad;

            return substr($value, $beforePad) == str_repeat(substr($value, -1), $pad);
        }

        /**
         * Decrypt
         *
         * @param string $value Value to decrypt
         * @param string $iv    Input vector
         *
         * @return string|false
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function mcryptDecrypt($value, $iv)
        {
            try {
                return mcrypt_decrypt($this->cipher, $this->key, $value, $this->mode, $iv);
            } catch(\Exception $e) {
                return false;
            }
        }
    }
}
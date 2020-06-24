<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_encrypt {

    protected $encryptKey = 'abcdefghijk123456789lmnopqrstuvwxy';
    protected $l_pad = 4;
    protected $r_pad = 4;
    protected $l_text = '';
    protected $r_text = '';
    protected $dirty = array("=");
    protected $clean = array("#");

    function __construct() {
        $this->set_key();
    }

    /**
     * Set the encryption key
     *
     * @param	string
     * @return	NA
     */
    public function set_key($key = '') {

        if ($key === '') {
            if ($this->encryptKey !== '') {
                $key = $this->encryptKey;
            } else {
                $key = config_item('encryption_key');
            }

            if (!strlen($key)) {
                show_error('In order to use the encryption class requires that you set an encryption key in your config file.');
            }
        }
        $this->encryptKey = md5($key);
        $this->set_l_pad();
        $this->set_r_pad();
        $this->set_l_text();
        $this->set_r_text();
    }

    /**
     * Fetch the encryption key
     *
     * Returns it as MD5 in order to have an exact-length 128 bit key.
     * Mcrypt is sensitive to keys that are not the correct length
     *
     * @param	string
     * @return	string
     */
    public function get_key() {
        return $this->encryptKey;
    }

    /**
     * Set the l_pad length
     *
     * @param	string
     * @return	NA
     */
    public function set_l_pad($l_pad = 4) {
        $this->l_pad = $l_pad;
    }

    /**
     * Set the r_pad length
     *
     * @param	string
     * @return	CI_Encrypt
     */
    public function set_r_pad($r_pad = 4) {
        return $this->r_pad = $r_pad;
    }

    /**
     * Set the l_text string
     *
     * @param	string
     * @return	CI_Encrypt
     */
    public function set_l_text($l_text = '') {
        $this->l_text = substr($this->encryptKey, 0, $this->l_pad);
    }

    /**
     * Set the r_text string
     *
     * @param	string
     * @return	CI_Encrypt
     */
    public function set_r_text($r_text = '') {

        $this->r_text = substr($this->encryptKey, strlen($this->encryptKey) - $this->r_pad, $this->r_pad);
    }

    /**
     * encode the value
     *
     * @param	string
     * @return	encrypted value string
     */
    public function c_encode($val = '') {
        $str = base64_encode($this->l_text . str_rot13($val) . $this->r_text);
        $str = str_replace($this->dirty, $this->clean, $str);
        return $str;
    }

    /**
     * decode the value
     *
     * @param	string
     * @return	decrypted value string
     */
    public function c_decode($val = '') {
        $val = str_replace($this->clean, $this->dirty, $val);
        $val = base64_decode($val);
        $strLen = strlen($val);
        $str = substr($val, $this->l_pad);
        $str = substr($str, 0, ($strLen - ($this->l_pad + $this->r_pad)));
        return str_rot13($str);
    }

    public function show_value() {
        echo '<br>$this->encryptKey = ' . $this->encryptKey . '<br>';
        echo '$this->l_pad = ' . $this->l_pad . '<br>';
        echo '$this->r_pad = ' . $this->r_pad . '<br>';
        echo '$this->l_text = ' . $this->l_text . '<br>';
        echo '$this->r_text = ' . $this->r_text . '<br>';
    }

}

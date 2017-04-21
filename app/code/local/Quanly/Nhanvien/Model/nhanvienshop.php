<?php

    class Quanly_Nhanvien_Model_nhanvienshop extends Mage_Core_Model_Abstract
    {
        public function _construct(){
            parent::_construct();
            $this->_init('nhanvien/nhanvienshop');
        }
    }
?>
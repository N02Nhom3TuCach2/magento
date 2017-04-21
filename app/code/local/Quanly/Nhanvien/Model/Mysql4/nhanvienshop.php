<?php

class Quanly_Nhanvien_Model_Mysql4_nhanvienshop extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('nhanvien/nhanvienshop', 'nhanvien_id');
    }
}
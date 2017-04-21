<?php
class Quanly_Nhanvien_Model_Mysql4_nhanvienshop_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('nhanvien/nhanvienshop');
    }
}
<?php
class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_nhanvienshop';
        $this->_blockGroup = 'nhanvien';
        $this->_headerText = Mage::helper('nhanvien')->__('Quản lý nhân viên');
        $this->_addButtonLabel = Mage::helper('nhanvien')->__('Thêm nhân viên');
        parent::__construct();
        //$this->_removeButton('add');
    }
}
<?php
class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()  {
        parent::__construct();  $this->setId('nhanvien_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('nhanvien')->__('Thông tin nhân viên'));
        }

        /**
        * prepare before render block to html
        *
        * @return Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Edit_Tabs
        */
        protected function _beforeToHtml()
        {
            $this->addTab('form_section', array(
            'label' => Mage::helper('nhanvien')->__('Thông tin nhân viên'),
            'title' => Mage::helper('nhanvien')->__('Thông tin nhân viên'),
            'content' => $this->getLayout()
            ->createBlock('nhanvien/adminhtml_nhanvienshop_edit_tab_form')
            ->toHtml(),
        ));
        return parent::_beforeToHtml();
        }
    }
?>
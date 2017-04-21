<?php
    class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
    {
        public function __construct()  {
            parent::__construct();  $this->_objectId = 'id';
            $this->_blockGroup = 'nhanvien';
            $this->_controller = 'adminhtml_nhanvienshop';

            $this->_updateButton('save', 'label', Mage::helper('nhanvien')->__('Lưu'));
            $this->_updateButton('delete', 'label', Mage::helper('nhanvien')->__('Xóa'));

            $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Lưu và tiếp tục sửa'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
            ), -100);

            $this->_formScripts[] = "
                function toggleEditor() {
                if (tinyMCE.getInstanceById('nhanvien_content') == null) {
                tinyMCE.execCommand('mceAddControl', false, 'nhanvien_content');
                } else {
                tinyMCE.execCommand('mceRemoveControl', false, 'nhanvien_content');
                }
                }
                
                function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
                }
            ";
        }
    }
?>
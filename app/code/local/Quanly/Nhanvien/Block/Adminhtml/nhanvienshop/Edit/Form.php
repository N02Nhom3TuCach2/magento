<?php
    class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
    {
        /**
        * prepare form's information for block
        *
        * @return Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Edit_Form
        */
        protected function _prepareForm(){
            $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
            'id' => $this->getRequest()->getParam('id'),
            'store' => $this->getRequest()->getParam('store'),
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
            ));

            $form->setUseContainer(true);
            $this->setForm($form);
            return parent::_prepareForm();
        }
    }
?>
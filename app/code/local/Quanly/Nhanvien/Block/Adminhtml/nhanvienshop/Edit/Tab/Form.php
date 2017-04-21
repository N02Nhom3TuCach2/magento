<?php
class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**  * prepare tab form's information  *
     * @return Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Edit_Tab_Form  */
        protected function _prepareForm()  {
            $form = new Varien_Data_Form();  $this->setForm($form);

            if (Mage::getSingleton('adminhtml/session')->getSalestaffData()) {
            $data = Mage::getSingleton('adminhtml/session')->getSalestaffData();
            Mage::getSingleton('adminhtml/session')->setSalestaffData(null);
            } elseif (Mage::registry('nhanvien_data')) {
            $data = Mage::registry('nhanvien_data')->getData();
            }
            $fieldset = $form->addFieldset('nhanvien_form', array(
            'legend'=>Mage::helper('nhanvien')->__('Staff information')
            ));

            /*Edit truong kieu text*/
            $fieldset->addField('hoten', 'text', array(
            'label' => Mage::helper('nhanvien')->__('Họ và tên'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'hoten',
            ));

            $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('nhanvien')->__('Email'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'email',
            ));
            $fieldset->addField('facebook_url', 'text', array(
            'label' => Mage::helper('nhanvien')->__('Địa chỉ Facebook'),
            'name' => 'facebook_url',
            ));

            $fieldset->addField('avatar', 'text', array(
                'label' => Mage::helper('nhanvien')->__('Hình đại diện'),
                'name' => 'avatar',
            ));

            /*Edit truong kieu date*/
            $fieldset->addField('ngaysinh', 'date', array(
            'label' => Mage::helper('nhanvien')->__('Ngày Sinh'),
            'name' => 'ngaysinh',
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'/adminhtml/default/default/images/grid-cal.gif',
            ));
            /*Edit truong kieu select*/
            $fieldset->addField('gioitinh', 'select', array(
            'label' => Mage::helper('nhanvien')->__('Giới tính'),
            'name' => 'gioitinh',
            'onclick' => "",
            'onchange' => "",
            'values' => array('-1'=>'Vui lòng chọn..','1' => 'Nam','2' => 'Nữ'),
            'disabled' => false,
            'readonly' => false,
            'tabindex' => 1
            ));
            /*View truong kieu note*/
            if($this->getRequest()->getParam('id')){
                $fieldset->addField('soluongsp', 'note', array(
                'label' => Mage::helper('nhanvien')->__('Số lượng SP'),
                'name' => 'soluongsp',
                'text' => $data['soluongsp']
                ));
            }

            $form->setValues($data);
            return parent::_prepareForm();
        }
    }
?>
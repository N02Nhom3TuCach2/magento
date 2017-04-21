<?php
    class Quanly_Nhanvien_Block_Grid extends Mage_Core_Block_Template {
        //construct function
        public function __construct() {
            parent::__construct();
            $collection = $this->getnhanvienshopCollection();
            $this->setCollection($collection);
        }
        //prepare layout
        public function _prepareLayout() {
            parent::_prepareLayout();
            $pager = $this->getLayout()->createBlock('page/html_pager', 'nhanvien.pager')->setCollection($this->getCollection());
            $this->setChild('pager', $pager);
            return $this;
        }

        public function getPagerHtml() {
            return $this->getChildHtml('pager');
        }

        public function getnhanvienshopCollection() {
            $collection = Mage::getModel('nhanvien/nhanvienshop')->getCollection();
            return $collection;
        }

        public function getgioitinhLabel($nhanvien) {
            if ($nhanvien->getId()) {
                if ($nhanvien->getgioitinh() == 1)
                    return Mage::helper('nhanvien')->__('Nam');
            }
            return Mage::helper('nhanvien')->__('Nữ');
        }

        public function gettrangthaiLabel($nhanvien) {
            if ($nhanvien->getId()) {
                if ($nhanvien->gettrangthai() == 1)
                    return Mage::helper('nhanvien')->__('Hiệu lực');
            }
            return Mage::helper('nhanvien')->__('Vô hiệu');
        }
    }
?>
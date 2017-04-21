<?php
class Quanly_Nhanvien_Adminhtml_nhanvienshopController extends Mage_Adminhtml_Controller_Action
{
    /**
     * index action
     */
    public function indexAction()
    {
        $this->loadLayout()
            ->renderLayout();
    }

    /**
     * mass delete nhanvienshop(s) action
     */
    public function massDeleteAction() {
        $nhanvienIds = $this->getRequest()->getParam('nhanvienshop');
        if (!is_array($nhanvienIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Vui lòng chọn nhân viên muốn xóa!'));
        } else {
            try {
                foreach ($nhanvienIds as $nhanvienId) {
                    $nhanvien = Mage::getModel('nhanvien/nhanvienshop')->load($nhanvienId);
                    $nhanvien->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('%d bản ghi đã được xóa thành công!', count($nhanvienIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * mass change status for staff(s) action
     */
    public function massStatusAction() {
        $nhanvienIds = $this->getRequest()->getParam('nhanvienshop');
        if (!is_array($nhanvienIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Vui lòng chọn nhân viên cần thay đổi'));
        } else {
            try {
                foreach ($nhanvienIds as $nhanvienId) {
                    Mage::getSingleton('nhanvien/nhanvienshop')
                        ->load($nhanvienId)
                        ->settrangthai($this->getRequest()->getParam('trangthai'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('%d bản ghi đã được thay đổi', count($nhanvienIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }


    /**
     * edit action
     */
    public function editAction(){
        $nhanvienId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('nhanvien/nhanvienshop')->load($nhanvienId);

        if ($model->getId() || $nhanvienId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('nhanvien_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('nhanvien/nhanvien');

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Quản lý nhân viên'),
                Mage::helper('adminhtml')->__('Quản lý nhân viên')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('nhanvien/adminhtml_nhanvienshop_edit'))
                ->_addLeft($this->getLayout()->createBlock('nhanvien/adminhtml_nhanvienshop_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('nhanvien')->__('Nhân viên không tồn tại!')
            );
            $this->_redirect('*/*/');
        }
    }
    /*new action*/
    public function newAction(){
        $this->_forward('edit');
    }

    /*
     * save nhan vien
     */

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('nhanvien/nhanvienshop');
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('nhanvien')->__('Nhân viên đã được lưu lại')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
    }

    /**
     * delete item action
     */
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('nhanvien/nhanvienshop');
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Nhân viên đã được xóa')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
}
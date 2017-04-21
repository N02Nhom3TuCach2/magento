<?php
class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('nhanvienGrid');
        $this->setDefaultSort('nhanvien_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * lay ra collection can hien thi len grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('nhanvien/nhanvienshop')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * hàm chuẩn bị trước khi in ra grid
     */
    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addFieldToFilter('store_id', $value);
    }

    protected function _prepareColumns()
    {
        $this->addColumn('nhanvien_id', array(
            'header'    => Mage::helper('nhanvien')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'nhanvien_id',
        ));

        $this->addColumn('hoten', array(
            'header'    => Mage::helper('nhanvien')->__('Họ và tên'),
            'align'     =>'left',
            'index'     => 'hoten',
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('nhanvien')->__('Địa chỉ Email'),
            'align'     =>'left',
            'index'     => 'email',
            'renderer'  =>   'nhanvien/adminhtml_nhanvienshop_renderer_email'
        ));

        $this->addColumn('facebook_url', array(
            'header'    => Mage::helper('nhanvien')->__('Địa chỉ Facebook'),
            'align'     =>'left',
            'index'     => 'facebook_url',
            'renderer'  =>   'nhanvien/adminhtml_nhanvienshop_renderer_link'
        ));

        $this->addColumn('avatar', array(
            'header'    => Mage::helper('nhanvien')->__('Hình đại diện'),
            'align'     =>'center',
            'index'     => 'avatar',
            'sortable'      => false,
            'filter'      => false,
            'renderer'  =>   'nhanvien/adminhtml_nhanvienshop_renderer_avatar'
        ));

        $this->addColumn('ngaysinh', array(
            'header'    => Mage::helper('nhanvien')->__('Ngày sinh'),
            'width'     => '150px',
            'index'     => 'ngaysinh',
            'type'		=> 'date'
        ));

        $this->addColumn('gioitinh', array(
            'header'    => Mage::helper('nhanvien')->__('Giới tính'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'gioitinh',
            'type'        => 'options',
            'options'     => array(
                1 => 'Nam',
                2 => 'Nữ',
            ),
        ));

        $this->addColumn('soluongsp', array(
            'header' => Mage::helper('nhanvien')->__('Số lượng SP'),
            'align' =>'left',
            'width' => '100px',
            'index' => 'soluongsp',
            'type' => 'number'
        ));

        $currencyCode = Mage::app()->getStore()->getBaseCurrency()->getCode();
        $this->addColumn('tongdoanhthu', array(
            'header' => Mage::helper('nhanvien')->__('Tổng doanh thu'),
            'align' =>'right',
            'width' => '100px',
            'index' => 'tongdoanhthu',
            'type' => 'price',
            'currency_code' => $currencyCode
        ));

        $this->addColumn('trangthai', array(
            'header'    => Mage::helper('nhanvien')->__('Trạng thái'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'trangthai',
            'type'        => 'options',
            'options'     => array(
                1 => 'Hiệu lực',
                2 => 'Vô hiệu',
            ),
        ));

        return parent::_prepareColumns();
    }
    /**
     * prepare mass action for this grid
     *
     * @return Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Grid
     */
    protected function _prepareMassaction() {
        $this->setMassactionIdField('nhanvien_id');
        $this->getMassactionBlock()->setFormFieldName('nhanvienshop');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('nhanvien')->__('Xóa'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('nhanvien')->__('Bạn có chắc muốn xóa?')
        ));

        /*mass change status*/
        $statuses = array(
            1 => Mage::helper('nhanvien')->__('Hiệu lực'),
            2 => Mage::helper('nhanvien')->__('Vô hiệu')
        );
        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('nhanvien')->__('Thay đổi trạng thái'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'trangthai',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('nhanvien')->__('Trạng thái'),
                    'values' => $statuses
                ))
        ));
        return $this;
    }
    /**
     * hàm trả lại url cho mỗi row trong grid
     */
    /**
     * get url for each row in grid
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
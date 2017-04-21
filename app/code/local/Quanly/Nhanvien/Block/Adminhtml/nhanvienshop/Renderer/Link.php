<?php
    class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Renderer_Link extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
    {
        /* Render Grid Column*/
        public function render(Varien_Object $row)
        {
            if($row->getFacebookUrl())
                return sprintf('
                    <a href="https://%s">%s</a>',
                    $row->getFacebookUrl(),
                    $row->getFacebookUrl()
                );
        }
    }
?>
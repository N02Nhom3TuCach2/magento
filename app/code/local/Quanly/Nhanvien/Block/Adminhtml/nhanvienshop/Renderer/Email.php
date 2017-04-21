<?php
    class Quanly_Nhanvien_Block_Adminhtml_nhanvienshop_Renderer_Email extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
    {
        /* Render Grid Column*/
        public function render(Varien_Object $row)      {
            if($row->getEmail())
                 return sprintf('
                    <a href="mailto:%s">%s</a>',
                    $row->getEmail(),
                    $row->getEmail()
            );
        }
    }
?>
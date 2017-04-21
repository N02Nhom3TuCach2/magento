<?php

    /** @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;

    $installer->startSetup();

    /**
     * tao bang salestaff_staff
     */
        $installer->run("
        
        DROP TABLE IF EXISTS {$this->getTable('quanly_nhanvien')};
        
        CREATE TABLE {$this->getTable('quanly_nhanvien')} (
          `nhanvien_id` int(11) unsigned NOT NULL auto_increment,
          `hoten` varchar(255) NOT NULL default '',
          `ngaysinh` date NULL,
          `gioitinh` smallint(1) NOT NULL default '1',
          `trangthai` smallint(6) NOT NULL default '1',
          `tongdoanhthu` decimal(11,2) NOT NULL default '1',
          `soluongsp` int(11) NOT NULL default '0',
          PRIMARY KEY (`nhanvien_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
        ");

    $installer->endSetup();
?>



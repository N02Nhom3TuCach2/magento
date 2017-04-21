<?php
    $installer = $this;

    $installer->startSetup();

    /**
     * create pdfinvoiceplus table
     */
    $installer->run("
    ALTER TABLE {$this->getTable('quanly_nhanvien')}
     ADD COLUMN `email` VARCHAR(255) NOT NULL default '',
     ADD COLUMN `facebook_url` VARCHAR(255) NOT NULL default '',
     ADD COLUMN `avatar` VARCHAR(255) NOT NULL default '';
    ");

    $installer->endSetup();
?>
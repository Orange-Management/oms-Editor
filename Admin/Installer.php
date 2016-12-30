<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Editor\Admin;

use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Editor install class.
 *
 * @category   Modules
 * @package    Modules\Editor
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Installer extends InstallerAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function install(string $path, DatabasePool $dbPool, InfoManager $info)
    {
        parent::install($path, $dbPool, $info);

        switch ($dbPool->get('core')->getType()) {
            case DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'editor_doc` (
                            `editor_doc_id` int(11) NOT NULL AUTO_INCREMENT,
                            `editor_doc_title` varchar(250) NOT NULL,
                            `editor_doc_plain` text NOT NULL,
                            `editor_doc_content` text NOT NULL,
                            `editor_doc_path` varchar(255) NOT NULL,
                            `editor_doc_created_at` datetime NOT NULL,
                            `editor_doc_created_by` int(11) NOT NULL,
                            PRIMARY KEY (`editor_doc_id`),
                            KEY `editor_doc_created_by` (`editor_doc_created_by`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'editor_doc`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'editor_doc_ibfk_1` FOREIGN KEY (`editor_doc_created_by`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'editor_tag` (
                            `editor_tag_id` int(11) NOT NULL AUTO_INCREMENT,
                            `editor_tag_doc` int(11) NOT NULL,
                            `editor_tag_tag` varchar(20) NOT NULL,
                            PRIMARY KEY (`editor_tag_id`),
                            KEY `editor_tag_doc` (`editor_tag_doc`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'editor_tag`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'editor_tag_ibfk_1` FOREIGN KEY (`editor_tag_doc`) REFERENCES `' . $dbPool->get('core')->prefix . 'editor_doc` (`editor_doc_id`);'
                )->execute();
                break;
        }
    }
}

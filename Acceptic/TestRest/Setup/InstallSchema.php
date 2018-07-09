<?php
namespace Acceptic\TestRest\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

use Acceptic\TestRest\Api\Schema\ShopperInterface;
use Acceptic\TestRest\Api\Schema\OrderInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists(ShopperInterface::TABLE_NAME)) {
            $shopperTable = $installer->getConnection()->newTable(
                $installer->getTable(ShopperInterface::TABLE_NAME)
            )->addColumn(
                ShopperInterface::ID_COLUMN,
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true
                ],
                'Shopper Entity ID'
            )->addColumn(
                ShopperInterface::EMAIL_COLUMN,
                Table::TYPE_TEXT,
                30,
                [],
                'Shopper email'
            )->addColumn(
                ShopperInterface::NAME_COLUMN,
                Table::TYPE_TEXT,
                20,
                [
                    'nullable' => false
                ],
                'Shopper Name'
            )->addColumn(
                ShopperInterface::LAST_NAME_COLUMN,
                Table::TYPE_TEXT,
                20,
                [],
                'Shopper Last Name'
            )->addColumn(
                ShopperInterface::PHONE_COLUMN,
                Table::TYPE_TEXT,
                20,
                [],
                'Shopper Phone'
            )->addColumn(
                ShopperInterface::CITY_COLUMN,
                Table::TYPE_TEXT,
                20,
                [],
                'Shopper Phone'
            )->addColumn(
                ShopperInterface::STREET_COLUMN,
                Table::TYPE_TEXT,
                20,
                [],
                'Shopper Street'
            )->addColumn(
                ShopperInterface::HOUSE_NUMBER_COLUMN,
                Table::TYPE_INTEGER,
                4,
                [],
                'Shopper Phone'
            )->setComment('Shopper Table');
            $installer->getConnection()->createTable($shopperTable);
        }

        if (!$installer->tableExists(OrderInterface::TABLE_NAME)) {
            $orderTable = $installer->getConnection()->newTable(
                $installer->getTable(OrderInterface::TABLE_NAME)
            )->addColumn(
                OrderInterface::ID_COLUMN,
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true
                ],
                'Order Entity ID'
            )->addColumn(
                OrderInterface::SHOPPER_ID_COLUMN,
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'unsigned' => true
                ],
                'Order Shopper ID'
            )->addColumn(
                OrderInterface::ORDER_TOTAL_COLUMN,
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true],
                'Order Total'
            )->addColumn(
                OrderInterface::TOKEN_COLUMN,
                Table::TYPE_TEXT,
                20,
                [],
                'Order Token'
            )->addForeignKey(
                $installer->getFkName(
                    OrderInterface::TABLE_NAME,
                    OrderInterface::SHOPPER_ID_COLUMN,
                    ShopperInterface::TABLE_NAME,
                    ShopperInterface::ID_COLUMN
                ),
                OrderInterface::SHOPPER_ID_COLUMN,
                $installer->getTable(ShopperInterface::TABLE_NAME),
                ShopperInterface::ID_COLUMN,
                Table::ACTION_CASCADE
            )->setComment('Order Table');

            $installer->getConnection()->createTable($orderTable);
        }

        $installer->endSetup();
    }
}

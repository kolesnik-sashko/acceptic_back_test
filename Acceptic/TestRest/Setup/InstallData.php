<?php

namespace Acceptic\TestRest\Setup;

use PSR\Log\LoggerInterface;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

use Acceptic\TestRest\Model\OrderFactory;
use Acceptic\TestRest\Model\ShopperFactory;
use Acceptic\TestRest\Api\OrderRepositoryInterface;
use Acceptic\TestRest\Api\ShopperRepositoryInterface;

class InstallData implements InstallDataInterface
{
    private $shopperFactory;

    private $shopperRepository;

    private $orderFactory;

    private $orderRepository;

    /** @var  LoggerInterface */
    private $logger;

    private $cities = ['London', 'New York', 'Paris', 'Milan', 'Kiev'];

    public function __construct(
        ShopperFactory $shopperFactory,
        ShopperRepositoryInterface $shopperRepository,
        OrderFactory $orderFactory,
        OrderRepositoryInterface $orderRepository,
        LoggerInterface $logger
    ){
        $this->shopperFactory    = $shopperFactory;
        $this->shopperRepository = $shopperRepository;
        $this->orderFactory      = $orderFactory;
        $this->orderRepository   = $orderRepository;
        $this->logger            = $logger;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        for ($shopperIndex = 1; $shopperIndex <= 10; $shopperIndex++) {
            $shopper = $this->shopperFactory->create();
            $shopper->setEmail(sprintf('test_email%s.gmail.com', $shopperIndex))
                ->setName(sprintf('TestName #%d', $shopperIndex))
                ->setLastName(sprintf('TestLName #%d', $shopperIndex))
                ->setPhone(sprintf('test phone #%d', $shopperIndex))
                ->setCity($this->cities[array_rand($this->cities)])
                ->setStreet(sprintf('Test Street #%d', $shopperIndex))
                ->setHouseNumber(sprintf('21/%d', $shopperIndex));
            try {
                $this->shopperRepository->save($shopper);
            } catch (\Exception $e) {
                $this->logger->error($e);
            }
            for ($orderIndex = 1; $orderIndex <= 3; $orderIndex++) {
                $order = $this->orderFactory->create();
                $order->setShopperId($shopper->getId())
                    ->setOrderTotal(rand(100, 1000))
                    ->setToken(uniqid());
                try {
                    $this->orderRepository->save($order);
                } catch (\Exception $e) {
                    $this->logger->error($e);
                }
            }
        }
    }
}

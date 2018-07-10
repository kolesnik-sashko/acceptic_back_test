<?php

namespace Acceptic\TestRest\Controller\Adminhtml;

use Magento\Framework\App\ActionInterface;
use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Registry;

use Acceptic\TestRest\Api\Data\ShopperInterface;
use Acceptic\TestRest\Api\ShopperRepositoryInterface;
use Acceptic\TestRest\Model\ShopperFactory;
use Acceptic\TestRest\Model\OrderFactory;

abstract class AbstractAction extends Action
{
    const ACL_RESOURCE          = 'Acceptic_TestRest::main';
    const MENU_ITEM             = 'Acceptic_TestRest::main';
    const PAGE_TITLE            = 'Shopper list';
    const BREADCRUMB_TITLE      = 'Shopper list';
    const QUERY_PARAM_ID        = 'shopper_id';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var ShopperFactory
     */
    protected $shopperFactory;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var ShopperInterface
     */
    protected $model;

    /**
     * @var Page
     */
    protected $resultPage;

    /**
     * @var ShopperRepositoryInterface
     */
    protected $repository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AbstractAction constructor.
     * @param Context $context
     * @param Registry $registry
     * @param PageFactory $pageFactory
     * @param ShopperRepositoryInterface $repository
     * @param ShopperFactory $factory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        ShopperRepositoryInterface $repository,
        ShopperFactory $factory,
        LoggerInterface $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $repository;
        $this->modelFactory   = $factory;
        $this->logger         = $logger;
        parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        $this->setPageData();
        return $this->resultPage;
    }

    /**
     * @return Page
     */
    protected function getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }
        return $this->resultPage;
    }

    /**
     * @return ActionInterface
     */
    protected function setPageData()
    {
        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        return $this;
    }

    /**
     * @return ShopperInterface
     */
    protected function getShopperModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }
        return $this->model;
    }

    /**
     * @return ShopperInterface
     */
    protected function getOrderModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }
        return $this->model;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);
        return $result;
    }

    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/');
    }

    /**
     * @return ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());
        return $redirect;
    }
}
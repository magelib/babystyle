<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-search-sphinx
 * @version   1.0.26
 * @copyright Copyright (C) 2016 Mirasvit (https://mirasvit.com/)
 */


namespace Mirasvit\Search\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Registry;
use Mirasvit\Search\Model\SynonymFactory;

abstract class Synonym extends Action
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var SynonymFactory
     */
    protected $synonymFactory;

    /**
     * @var \Magento\Backend\Model\Session
     */
    protected $session;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * Constructor
     *
     * @param Context        $context
     * @param Registry       $registry
     * @param SynonymFactory $synonymFactory
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Context $context,
        Registry $registry,
        SynonymFactory $synonymFactory,
        ForwardFactory $resultForwardFactory
    ) {
        $this->context = $context;
        $this->registry = $registry;
        $this->synonymFactory = $synonymFactory;
        $this->session = $context->getSession();
        $this->resultForwardFactory = $resultForwardFactory;

        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Mirasvit_Search::search');

        $resultPage->getConfig()->getTitle()->prepend(__('Manage Synonyms'));

        return $resultPage;
    }

    /**
     * Init synonym model
     *
     * @return \Mirasvit\Search\Model\Synonym
     */
    protected function initModel()
    {
        $model = $this->synonymFactory->create();

        if ($this->getRequest()->getParam('id')) {
            $model->load($this->getRequest()->getParam('id'));
        }

        $this->registry->register('current_model', $model);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->context->getAuthorization()->isAllowed('Mirasvit_Search::search_synonym');
    }
}

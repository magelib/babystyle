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


namespace Mirasvit\Search\Controller\Adminhtml\Stopword;

use Magento\TestFramework\TestCase\AbstractBackendController;

class IndexTest extends AbstractBackendController
{
    public function setUp()
    {
        $this->resource = 'Mirasvit_Search::search_stopword';
        $this->uri = 'backend/search/stopword/index';

        parent::setUp();
    }

    /**
     * @covers Mirasvit\Search\Controller\Adminhtml\Stopword\Index::execute
     */
    public function testIndexAction()
    {
        $this->dispatch('backend/search/stopword/index');
        $body = $this->getResponse()->getBody();

        $this->assertNotEmpty($body);
        $this->assertNotEquals('noroute', $this->getRequest()->getControllerName());
        $this->assertFalse($this->getResponse()->isRedirect());
        $this->assertContains('Add New Stopword', $body);
    }
}

<?php

namespace Learning\ClothingMaterial\Model\Attribute\Source;

use Magento\Cms\Model\BlockRepository;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CmsBlock extends AbstractSource
{
    const CMS_BLOCK_ATTRIBUTE = 'test_cms_block_attribute';

    private $blockRepository;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var FilterGroupBuilder
     */
    private $filterGroupBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    protected $_options;

    public function __construct(
        BlockRepository $blockRepository,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->blockRepository = $blockRepository;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Get All options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        $filter = $this->filterBuilder->setField('title')
            ->setConditionType('notnull')
            ->create();

        $this->searchCriteriaBuilder->addFilters([$filter]);
        $this->searchCriteriaBuilder->setPageSize(20);

        $searchCriteria = $this->searchCriteriaBuilder->create();

        if (!$this->_options) {
            $list = $this->blockRepository->getList($searchCriteria);
            $items = $list->getItems();
            foreach ($items as $item) {
                $this->_options[] = [
                 'value' => $item->getId(),
                 'label' => $item->getTitle()
                ];
            }
        }
        return $this->_options;
    }
}

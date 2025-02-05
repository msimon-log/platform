<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Document\Renderer;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;

final class OrderDocumentCriteriaFactory
{
    /**
     * @internal
     */
    private function __construct()
    {
    }

    public static function create(array $ids, string $deepLinkCode = ''): Criteria
    {
        $criteria = new Criteria($ids);

        $criteria->addAssociations([
            'lineItems',
            'transactions.paymentMethod',
            'currency',
            'language.locale',
            'addresses.country',
            'addresses.countryState',
            'deliveries.positions',
            'deliveries.shippingMethod',
            'deliveries.shippingOrderAddress.country',
            'deliveries.shippingOrderAddress.countryState',
            'orderCustomer.customer',
        ]);

        $criteria->getAssociation('lineItems')->addSorting(new FieldSorting('position'));
        $criteria->getAssociation('transactions')->addSorting(new FieldSorting('createdAt'));
        $criteria->getAssociation('deliveries')->addSorting(new FieldSorting('createdAt'));

        if ($deepLinkCode !== '') {
            $criteria->addFilter(new EqualsFilter('deepLinkCode', $deepLinkCode));
        }

        return $criteria;
    }
}

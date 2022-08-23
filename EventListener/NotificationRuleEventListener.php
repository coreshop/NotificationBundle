<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 */

declare(strict_types=1);

namespace CoreShop\Bundle\NotificationBundle\EventListener;

use CoreShop\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use CoreShop\Component\Notification\Model\NotificationRuleInterface;
use CoreShop\Component\Notification\Repository\NotificationRuleRepositoryInterface;

class NotificationRuleEventListener
{
    public function __construct(private NotificationRuleRepositoryInterface $repository)
    {
    }

    public function preCreate(ResourceControllerEvent $event): void
    {
        $object = $event->getSubject();

        if (!$object instanceof NotificationRuleInterface) {
            return;
        }

        $object->setSort(count($this->repository->findAll()) + 1);
    }
}

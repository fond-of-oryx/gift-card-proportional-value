<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Dependency\Injector;

use FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Command\GiftCardProportionalValueCalculatorCommandPlugin;
use FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Condition\HasRedeemedGiftCardsConditionPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Dependency\Injector\AbstractDependencyInjector;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollectionInterface;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionCollectionInterface;
use Spryker\Zed\Oms\OmsDependencyProvider;

class OmsDependencyInjector extends AbstractDependencyInjector
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function injectBusinessLayerDependencies(Container $container)
    {
        $container = parent::injectBusinessLayerDependencies($container);
        $container = $this->injectCommands($container);
        $container = $this->injectConditions($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function injectCommands(Container $container)
    {
        $container->extend(OmsDependencyProvider::COMMAND_PLUGINS, function (CommandCollectionInterface $commandCollection) {
            $commandCollection->add(new GiftCardProportionalValueCalculatorCommandPlugin(), 'GiftCardProportionalValue/CalculateProportionalValues');

            return $commandCollection;
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function injectConditions(Container $container)
    {
        $container->extend(OmsDependencyProvider::CONDITION_PLUGINS, function (ConditionCollectionInterface $conditionCollection) {
            $conditionCollection->add(new HasRedeemedGiftCardsConditionPlugin(), 'GiftCardProportionalValue/HasRedeemedGiftCards');

            return $conditionCollection;
        });

        return $container;
    }
}

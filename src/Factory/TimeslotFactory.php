<?php

namespace App\Factory;

use App\Entity\Timeslot;
use App\Repository\TimeslotRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Timeslot>
 *
 * @method        Timeslot|Proxy create(array|callable $attributes = [])
 * @method static Timeslot|Proxy createOne(array $attributes = [])
 * @method static Timeslot|Proxy find(object|array|mixed $criteria)
 * @method static Timeslot|Proxy findOrCreate(array $attributes)
 * @method static Timeslot|Proxy first(string $sortedField = 'id')
 * @method static Timeslot|Proxy last(string $sortedField = 'id')
 * @method static Timeslot|Proxy random(array $attributes = [])
 * @method static Timeslot|Proxy randomOrCreate(array $attributes = [])
 * @method static TimeslotRepository|ProxyRepositoryDecorator repository()
 * @method static Timeslot[]|Proxy[] all()
 * @method static Timeslot[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Timeslot[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Timeslot[]|Proxy[] findBy(array $attributes)
 * @method static Timeslot[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Timeslot[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TimeslotFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Timeslot::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'start' => self::faker()->dateTime(),
            'stopAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Timeslot $timeslot): void {})
        ;
    }
}

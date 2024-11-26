<?php

namespace App\Factory;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Project>
 *
 * @method        Project|Proxy create(array|callable $attributes = [])
 * @method static Project|Proxy createOne(array $attributes = [])
 * @method static Project|Proxy find(object|array|mixed $criteria)
 * @method static Project|Proxy findOrCreate(array $attributes)
 * @method static Project|Proxy first(string $sortedField = 'id')
 * @method static Project|Proxy last(string $sortedField = 'id')
 * @method static Project|Proxy random(array $attributes = [])
 * @method static Project|Proxy randomOrCreate(array $attributes = [])
 * @method static ProjectRepository|ProxyRepositoryDecorator repository()
 * @method static Project[]|Proxy[] all()
 * @method static Project[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Project[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Project[]|Proxy[] findBy(array $attributes)
 * @method static Project[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Project[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProjectFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public static function class(): string
    {
        return Project::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'archived' => false,
            'name' => sprintf('Project %s', self::faker()->randomNumber(2)),
            'startAt' => self::faker()->dateTime(),
            'deadline' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this->afterInstantiate(function(Project $project): void {
            
            $users = UserFactory::new()->createMany(6);
            foreach ($users as $user) {
                $project->addUser($user->object());
            }
            $tasks = TaskFactory::new()->createMany(6);
            foreach ($tasks as $index => $task) {
                $task = $task->object();
                $project->addTask($task);
                $task->setProject($project);
                $task->setUser($users[$index]->object());
            }

        })
        ;
    }
}

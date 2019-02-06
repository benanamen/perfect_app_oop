<?php declare(strict_types=1);

namespace PerfectApp\Utilitys;

/**
 * Class ActionMessages
 * @package PerfectApp\Utilitys
 */
class ActionMessages
{
    /**
     * @var array
     */
    private $actions;

    /**
     * ActionMessages constructor.
     * @param array $actions
     */
    public function __construct(array $actions)
    {
        $this->actions = $actions;
    }

    /**
     * @param $action
     * @return mixed|null
     */
    public function getStatus($actions)
    {
        return $this->actions[$actions] ?? null;
    }
}

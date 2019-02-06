<?php declare(strict_types=1);

namespace PerfectApp\Utilitys;

/**
 * Class MesssageJson
 * @package PerfectApp\Utilitys
 */
class MesssageJson implements MessageDisplay
{
    /**
     * @var ActionMessages
     */
    protected $action;

    /**
     * MesssageJson constructor.
     * @param ActionMessages $action
     */
    public function __construct(ActionMessages $action)
    {
        $this->action = $action;
    }

    /**
     * @param $action
     * @return string
     */
    public function render($action): string
    {
        $action = $this->action->getStatus($action);

        return <<<JSON
            {
                "message": {$action['message']},
                "status": {$action['status']}
            }
JSON;
    }
}

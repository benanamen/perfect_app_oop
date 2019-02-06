<?php declare(strict_types=1);

namespace PerfectApp\Utilities;

/**
 * Class MesssageHTML
 * @package PerfectApp\Utilities
 */
class MesssageHTML implements MessageDisplay
{
    /**
     * @var ActionMessages
     */
    protected $action;

    /**
     * MesssageHTML constructor.
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

        return <<<HTML
            <div class="col-md-6 offset-md-3">
                    <div class="{$action['status']}">{$action['message']}</div>
            </div>
HTML;
    }
}

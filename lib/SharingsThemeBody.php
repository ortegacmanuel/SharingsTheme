<?php

if (!defined('GNUSOCIAL')) { exit(1); }

class SharingsThemeBody {

    static function showBody($action) {

        $params = array('id' => $action->getActionName());

        $action->elementStart('body', $params);
        $action->elementStart('div', array('id' => 'wrap'));

        if (Event::handle('StartShowHeader', array($action))) {
            $action->showHeader();
            $action->flush();
            Event::handle('EndShowHeader', array($action));
        }

        $action->showContent();
        /* $action->showCore();
        $action->flush();
        if (Event::handle('StartShowFooter', array($action))) {
            $action->showFooter();
            $action->flush();
            Event::handle('EndShowFooter', array($action));
        }
        */
        $action->elementEnd('div');
        $action->showScripts();
        $action->elementEnd('body');

    }

}

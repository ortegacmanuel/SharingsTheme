<?php

class SharingsThemeNewAction extends NewSharingsAction {

    function showHeader() {
        SharingsThemeHeader::showHeader($this);
    }

    function showBody()
    {
        SharingsThemeBody::showBody($this);
    }


}

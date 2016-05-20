<?php

class SharingsThemeEditAction extends EditSharingsAction {

    function showHeader() {
        SharingsThemeHeader::showHeader($this);
    }

    function showBody()
    {
        SharingsThemeBody::showBody($this);
    }

    function showContent()
    {
        if (!empty($this->error)) {
            $this->element('p', 'error', $this->error);
        }

        $this->elementStart('div', array('class' => 'container main-container headerOffset'));


        $this->elementStart('div', array('class' => 'row'));

        $this->elementStart('div', array('class' => 'breadcrumbDiv col-lg-12'));

        $this->elementStart('ul', array('class' => 'breadcrumb'));

            $this->elementStart('li');
            $this->elementStart('a', array('href' => common_local_url('public')));
            $this->raw(_m('Inicio'));
            $this->elementEnd('a');
            $this->elementEnd('li');

            $this->elementStart('li');
            $this->elementStart('a', array('href' => common_local_url('sharingsthemedirectory')));
            $this->raw('Sharings');
            $this->elementEnd('a');
            $this->elementEnd('li');

            $this->elementStart('li');
            $this->raw(_m('Editar'));
            $this->elementEnd('li');

        $this->elementEnd('ul');

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'row'));

        $this->elementStart('div', array('class' => 'col-lg-9 col-md-9 col-sm-7 col-xs-6 col-xxs-12 text-center-xs'));

        $this->elementStart('h1', array('class' => 'section-title-inner'));
        $this->elementStart('span');

        $this->elementStart('i', array('class' => 'glyphicon glyphicon-edit'));
        $this->elementEnd('i');
        $this->raw(_m('Editar objeto o servicio'));
        $this->elementEnd('span');
        $this->elementEnd('h1');

        $this->elementEnd('div');

        $form = new EditSharingsThemeForm($this, $this->sharing);

        $form->show();

        $this->elementStart('div', array('class' => 'gap'));
        $this->elementEnd('div');

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');

        return;
    }

}

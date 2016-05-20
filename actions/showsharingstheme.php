<?php

class ShowSharingsThemeAction extends ShowSharingsAction {

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

        $user = common_current_user();

        $sharing = $this->sharings;

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
            $this->elementStart('a', array('href' => common_local_url('sharingsthemedirectory') . '?sharing_category_id=' . $sharing->sharing_category_id ));
            $this->raw(Sharing_category::getNameById($sharing->sharing_category_id));
            $this->elementEnd('a');
            $this->elementEnd('li');

            $this->elementStart('li');
            $this->raw($sharing->displayName);
            $this->elementEnd('li');

        $this->elementEnd('ul');

        $this->elementEnd('div');
        $this->elementEnd('div');



        $this->elementStart('div', array('class' => 'row transitionfx'));

        $this->elementStart('div', array('class' => 'col-lg-6 col-md-6 col-sm-6'));

            $this->elementStart('div', array('class' => 'main-image sp-wrap col-lg-12 no-padding'));

            $this->elementStart('a', array('href' => '#'));

            $image_url = File_to_sharing::getImageUrl($sharing);
            if($image_url == '') {
                $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));
            } else {
                $this->element('img', array('class' => 'img-responsive', 'src' => $image_url, 'alt' => 'img'));
            }

            $this->elementEnd('a');

            /*
            $this->elementStart('a', array('href' => '#'));

                $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));

            $this->elementEnd('a');

            $this->elementStart('a', array('href' => '#'));

                $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));

            $this->elementEnd('a');
            */

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'col-lg-6 col-md-6 col-sm-5'));

        $this->elementStart('h2', array('class' => 'product-title'));
            $this->raw($sharing->displayName);
        $this->elementEnd('h2');

        $this->elementStart('a', array('href' => common_local_url('sharingsthemedirectory') . '?sharing_category_id=' . $sharing->sharing_category_id ));
        $this->elementStart('span', array('class' => 'new-product'));
        $this->raw(Sharing_category::getNameById($sharing->sharing_category_id));
        $this->elementEnd('span');
        $this->elementEnd('a');

        $this->elementStart('a', array('href' => common_local_url('sharingsthemedirectory') . '?sharing_type_id=' . $sharing->sharing_type_id ));
        $this->elementStart('span', array('class' => 'discount'));
        $this->raw(Sharing_type::getNameById($sharing->sharing_type_id));
        $this->elementEnd('span');
        $this->elementEnd('a');

        $this->element('div', array('style' => 'clear:both'));

        $this->elementStart('div', array('class' => 'product-price'));
        $this->elementStart('span', array('class' => 'price-sales'));
        $this->raw($sharing->price);
        $this->elementEnd('span');
        $this->elementStart('span', array('class' => 'price-standard'));
        $this->raw($sharing->getPriceText());
        $this->elementEnd('span');
        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'details-description'));
        $this->elementStart('p');
        $this->raw($sharing->summary);
        $this->elementEnd('p');
        $this->elementEnd('div');

        $this->elementStart('h3', array('class' => 'incaps'));
        $this->element('i', array('class' => 'glyphicon glyphicon-map-marker'));
        $this->elementStart('a', array('href' => common_local_url('sharingsthemedirectory') . '?sharing_city_id=' . $sharing->sharing_city_id ));
        $this->raw(Sharing_city::getNameById($sharing->sharing_city_id));
        $this->elementEnd('a');
        $this->elementEnd('h3');

        $this->elementStart('div', array('class' => 'cart-actions'));

        if (!empty($user and $user->getProfile()->id != $sharing->profile_id)) {
            $form = new SharingsThemeResponseForm($sharing, $this);

            $form->show();

            $this->elementStart('div', array('class' => 'addto row'));

            $this->elementStart('div', array('class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12'));

            $this->elementStart('button', array('onclick' => 'document.getElementById("sharingresponse-form-' . $sharing->id . '").submit();', 'class' => 'button btn-block btn-cart cart first', 'title' => _m('Contactar con el usuario que comparte este objeto o servicio'), 'type' => 'button'));
            $this->raw(_m('Responder'));
            $this->elementEnd('button');
            $this->elementEnd('div');
            $this->elementEnd('div');
        } else {

            $this->elementStart('div', array('class' => 'addto row'));

            $this->elementStart('div', array('class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12'));

            $this->elementStart('a', array('class' => 'btn btn-block btn-primary', 'title' => _m('Contactar con el usuario que comparte este objeto o servicio'), 'href' => common_local_url('editsharings', array('id' => $sharing->id))));
            $this->raw(_m('Editar'));
            $this->elementEnd('a');
            $this->elementEnd('div');

            $this->elementStart('div', array('class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12'));

            $this->elementStart('a', array('class' => 'btn btn-block btn-danger', 'title' => _m('Contactar con el usuario que comparte este objeto o servicio'), 'href' => common_local_url('deletesharings', array('id' => $sharing->id))));
            $this->raw(_m('Eliminar'));
            $this->elementEnd('button');
            $this->elementEnd('div');

            $this->elementEnd('div');

        }

        $this->elementEnd('div');



        $this->elementEnd('div');

        $this->elementEnd('div');

        $sharing_categoria = new Sharing();
        $sharing_categoria->sharing_category_id = $sharing->sharing_category_id;
        
        if($sharing_categoria->find()) {

        $this->elementStart('div', array('class' => 'row recommended'));
        $this->elementStart('h1');
        $this->raw(_m('En la misma categoría'));
        $this->elementEnd('h1');

        $this->elementStart('div', array('id' => 'SimilarProductSlider'));

        while ($sharing_categoria->fetch()) {
        $this->elementStart('div', array('class' => 'item'));
        $this->elementStart('div', array('class' => 'product'));

        $this->elementStart('a', array('href' => common_local_url('showsharings', array('id' => $sharing_categoria->id)), 'class' => 'product-image'));

        $image_url = File_to_sharing::getImageUrl($sharing_categoria);
        if($image_url == '') {
            $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));
        } else {
            $this->element('img', array('class' => 'img-responsive', 'src' => $image_url, 'alt' => 'img'));
        }
        $this->elementEnd('a');

        $this->elementStart('div', array('class' => 'description'));

        $this->elementStart('h4', array('class' => 'san-remo-spaghetti'));
        $this->elementStart('a', array('href' => common_local_url('showsharings', array('id' => $sharing->id))));
        $this->raw($sharing_categoria->displayName);
        $this->elementEnd('a');
        $this->elementEnd('h4');

        $this->elementStart('div', array('class' => 'price'));

        $this->elementStart('span');
        $this->raw($sharing_categoria->getPriceText());
        $this->elementEnd('span');

        $this->elementEnd('div');
        $this->elementEnd('div');
        $this->elementEnd('div');
        $this->elementEnd('div');

        }

        $this->elementEnd('div');


        $this->elementEnd('div');

        }

    }

}

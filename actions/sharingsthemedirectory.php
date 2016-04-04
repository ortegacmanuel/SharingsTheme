<?php

class SharingsThemeDirectoryAction extends SharingsdirectoryAction {

    function showHeader() {
        SharingsThemeHeader::showHeader($this);
    }

    function showBody()
    {
        SharingsThemeBody::showBody($this);
    }

    function showContent()
    {


        $sharing = null;
        $sharing = $this->getSharings();
        $cnt     = 1;


        $this->elementStart('div', array('class' => 'container main-container'));
        $this->elementStart('div', array('class' => 'row featuredPostContainer globalPadding style2'));

            $this->elementStart('h3', array('class' => 'section-title style2 text-center'));
            $this->elementStart('span');
            $this->raw('Últimas ofertas y demandas');
            $this->elementEnd('span');
            $this->elementEnd('h3');

            $this->elementStart('div', array('class' => 'owl-carousel owl-theme', 'id' => 'productslider'));

        while ($sharing->fetch()) {

            $this->elementStart('div', array('class' => 'item'));

            $this->elementStart('div', array('class' => 'product'));

                $this->elementStart('a', array('class' => 'add-fav tooltipHere', 'data-toggle' => 'tooltip', 'data-original-title' => 'Agregar a favoritos', 'data-placement' => 'left'));
                $this->elementStart('i', array('class' => 'glyphicon glyphicon-heart'));
                $this->elementEnd('i');
                $this->elementEnd('a');
                $this->elementStart('div', array('class' => 'image'));
                $this->elementStart('div', array('class' => 'quickview'));

                $this->elementStart('a', array('data-toggle' => 'modal', 'class' => 'btn btn-xs btn-quickview', 'href' => common_local_url('showsharings', array('id' => $sharing->id)), 'data-target' => '#productSetailsModalAjax'));
                $this->raw('Ver');
                $this->elementEnd('a');
                $this->elementEnd('div');

                $this->elementStart('a', array('href' => 'product-details.html'));
                $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));
                $this->elementEnd('a');

                $this->elementStart('div', array('class' => 'promotion'));

                $this->elementStart('span', array('class' => 'new-product'));
                $this->raw(Sharing_category::getNameById($sharing->sharing_category_id));
                $this->elementEnd('span');
                $this->elementStart('span', array('class' => 'discount'));
                $this->raw(Sharing_type::getNameById($sharing->sharing_type_id));
                $this->elementEnd('span');
                $this->elementEnd('div');
                $this->elementEnd('div');

                $this->elementStart('div', array('class' => 'description'));

                $this->elementStart('h4');
                $this->elementStart('a', array('href' => common_local_url('respondsharings', array('id' => $sharing->id))));
                $this->raw($sharing->displayName);
                $this->elementEnd('a');
                $this->elementEnd('h4');

                $this->elementStart('p');
                $this->raw($sharing->summary);
                $this->elementEnd('p');

                $this->elementStart('span', array('class' => 'size'));
                $this->raw(Sharing_city::getNameById($sharing->sharing_city_id));
                $this->elementEnd('span');
                $this->elementEnd('div');

                $this->elementStart('div', array('class' => 'price'));
                $this->elementStart('span');
                $this->raw($sharing->price);
                $this->elementEnd('span');
                $this->elementEnd('div');

                $this->elementStart('div', array('class' => 'action-control'));
                $this->elementStart('a', array('class' => 'btn btn-primary'));
                $this->elementStart('span', array('class' => 'add2cart'));
                $this->elementStart('i', array('class' => 'glyphicon glyphicon-thumbs-up'));
                $this->elementEnd('i');
                $this->raw('Responder');
                $this->elementEnd('span');                
                $this->elementEnd('a');


            $this->elementEnd('div');
            $this->elementEnd('div');
            $this->elementEnd('div');

            }

            $this->elementEnd('div');
            $this->elementEnd('div');

        $this->elementEnd('div');
        $this->elementEnd('div');


        if (0 == $cnt) {
             $this->showEmptyListMessage();
        }

    }

}

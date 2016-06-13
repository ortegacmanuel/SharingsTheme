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

        $user = common_current_user();

        $sharing = null;
        $sharing = $this->getSharings();

        $nro_sharings = $sharing;
        $cnt = (int)$nro_sharings->count();

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
            $this->raw(_m('Catálogo'));
            $this->elementEnd('li');

        $this->elementEnd('ul');

        $this->elementEnd('div');
        $this->elementEnd('div');

        $form = new SharingsThemeDirectoryForm($this);

        $form->show();


        $this->elementStart('div', array('class' => 'col-lg-9 col-md-9 col-sm-12'));
        $this->elementStart('div', array('class' => 'w100 clearfix category-top'));

        $this->elementStart('h2');
        $this->raw(_m('Catálogo'));
        $this->elementEnd('h2');

        $this->elementEnd('div');

        /* ¿Mucha distracción antes de ver los objetos y servicios?
        $this->elementStart('div', array('class' => 'row subCategoryList clearfix'));
        $this->elementStart('div', array('class' => 'col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center '));
        $this->elementStart('div', array('class' => 'thumbnail equalheight'));

        $this->elementStart('a', array('href' => common_local_url('public'), 'class' => 'subCategoryThumb'));

        $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));
        $this->elementEnd('a');

        $this->elementStart('a', array('href' => common_local_url('public'), 'class' => 'subCategoryTitle'));
        $this->elementStart('span');
        $this->raw(_m('Hospitalidad'));
		$this->raw(_m('Intercambio de casas'));
		$this->raw(_m('Transporte y viajar juntos'));
		$this->raw(_m('Experiencias'));
		$this->raw(_m('Libros, Películas y Música'));
		$this->raw(_m('Tecnología e informáticax'));
		$this->raw(_m('Coches y motos'));
		$this->raw(_m('Deporte y Ocio'));
		$this->raw(_m('Muebles, Deco y Jardin'));
		$this->raw(_m('Consolas y Videojuegos'));
		$this->raw(_m('Moda y accesorios'));
		$this->raw(_m('Juguetes, Niños y Bebés'));
		$this->raw(_m('Inmobiliaria'));
		$this->raw(_m('Electrodomésticos'));
		$this->raw(_m('Servicios'));
		$this->raw(_m('Otros'));

        $this->raw(_m('Oferta'));
		$this->raw(_m('Demanda'));
        $this->elementEnd('span');
        $this->elementEnd('a');

        $this->elementEnd('div');
        $this->elementEnd('div');

 $this->elementStart('div', array('class' => 'col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center '));
        $this->elementStart('div', array('class' => 'thumbnail equalheight'));

        $this->elementStart('a', array('href' => common_local_url('public'), 'class' => 'subCategoryThumb'));

        $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));
        $this->elementEnd('a');

        $this->elementStart('a', array('href' => common_local_url('public'), 'class' => 'subCategoryTitle'));
        $this->elementStart('span');
        $this->raw(_m('Hospitalidad'));
		$this->raw(_m('Intercambio de casas'));
		$this->raw(_m('Transporte y viajar juntos'));
		$this->raw(_m('Experiencias'));
		$this->raw(_m('Libros, Películas y Música'));
		$this->raw(_m('Tecnología e informáticax'));
		$this->raw(_m('Coches y motos'));
		$this->raw(_m('Deporte y Ocio'));
		$this->raw(_m('Muebles, Deco y Jardin'));
		$this->raw(_m('Consolas y Videojuegos'));
		$this->raw(_m('Moda y accesorios'));
		$this->raw(_m('Juguetes, Niños y Bebés'));
		$this->raw(_m('Inmobiliaria'));
		$this->raw(_m('Electrodomésticos'));
		$this->raw(_m('Servicios'));
		$this->raw(_m('Otros'));

        $this->raw(_m('Oferta'));
		$this->raw(_m('Demanda'));
        $this->elementEnd('span');
        $this->elementEnd('a');

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');
        */

        $this->elementStart('div', array('class' => 'w100 productFilter clearfix'));

        $this->elementStart('p', array('class' => 'pull-left'));
        $this->raw(_m(sprintf(_m('Monstrando <strong>%d<strong> resultados'), $cnt)));
        $this->elementEnd('p');

        $this->elementStart('div', array('class' => 'pull-right'));
        $this->elementStart('div', array('class' => 'change-order pull-right'));
        $this->elementStart('select', array('class' => 'form-control', 'name' => 'orderby'));
            $this->elementStart('option', array('selected' => 'selected'));
            $this->raw(_m('Ordén por defecto'));
            $this->elementEnd('option');

            $this->elementStart('option', array('value' => 'popularidad'));
            $this->raw(_m('Ordén por popularidad'));
            $this->elementEnd('option');

            $this->elementStart('option', array('value' => 'valoracion'));
            $this->raw(_m('Ordén por valoración'));
            $this->elementEnd('option');

            $this->elementStart('option', array('value' => 'fecha'));
            $this->raw(_m('Los más recientes'));
            $this->elementEnd('option');

        $this->elementEnd('select');

        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'change-view pull-right'));

        $this->elementStart('a', array('href' => '#', 'class' => 'grid-view', 'title' => 'Grid'));
        $this->element('i', array('class' => 'fa fa-th-large'));

        $this->elementEnd('a');

        $this->elementStart('a', array('href' => '#', 'class' => 'list-view', 'title' => 'List'));
        $this->element('i', array('class' => 'fa fa-th-list'));

        $this->elementEnd('a');

        $this->elementEnd('div');
        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'row  categoryProduct xsResponse clearfix'));

        while ($sharing->fetch()) {

            $this->elementStart('div', array('class' => 'item col-sm-4 col-lg-4 col-md-4 col-xs-6'));

            $this->elementStart('div', array('class' => 'product'));

                $this->elementStart('a', array('class' => 'add-fav tooltipHere', 'data-toggle' => 'tooltip', 'data-original-title' => 'Agregar a favoritos', 'data-placement' => 'left'));
                $this->elementStart('i', array('class' => 'glyphicon glyphicon-heart'));
                $this->elementEnd('i');
                $this->elementEnd('a');
                $this->elementStart('div', array('class' => 'image'));
                $this->elementStart('div', array('class' => 'quickview'));

                $this->elementStart('a', array('class' => 'btn btn-xs btn-quickview', 'href' => common_local_url('showsharings', array('id' => $sharing->id))));
                $this->raw(_m('Ver'));
                $this->elementEnd('a');
                $this->elementEnd('div');

                $this->elementStart('a', array('href' => common_local_url('showsharings', array('id' => $sharing->id))));

                $image_url = File_to_sharing::getImageUrl($sharing);
                if($image_url == '') {
                    $this->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'), 'alt' => 'img'));
                } else {
                    $this->element('img', array('class' => 'img-responsive', 'src' => $image_url, 'alt' => 'img'));
                }
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
                $this->elementStart('a', array('href' => common_local_url('showsharings', array('id' => $sharing->id))));
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

                if (empty($user)) {

                    $this->elementStart('a', array('class' => 'btn btn-primary', 'href' => common_local_url('showsharings', array('id' => $sharing->id)), 'title' => _m('Editar o dar de baja tu objeto o servicio')));
                    $this->elementStart('span', array('class' => 'add2cart'));
                    $this->elementStart('i', array('class' => 'glyphicon glyphicon-info-sign'));
                    $this->elementEnd('i');
                    $this->raw(_m('Ver detalles'));
                    $this->elementEnd('span');                
                    $this->elementEnd('a');


                } elseif($user->getProfile()->id == $sharing->profile_id) {

                    $this->elementStart('a', array('class' => 'btn btn-primary', 'href' => common_local_url('showsharings', array('id' => $sharing->id)), 'title' => _m('Editar o dar de baja tu objeto o servicio')));
                    $this->elementStart('span', array('class' => 'add2cart'));
                    $this->elementStart('i', array('class' => 'glyphicon glyphicon-wrench'));
                    $this->elementEnd('i');
                    $this->raw(_m('Administrar'));
                    $this->elementEnd('span');                
                    $this->elementEnd('a');

                } else {

                    $form = new SharingsThemeResponseForm($sharing, $this);

                    $form->show();

                    $this->elementStart('a', array('class' => 'btn btn-primary', 'href' => '#', 'onclick' => 'document.getElementById("sharingresponse-form-' . $sharing->id . '").submit();', 'title' => _m('Contactar con el usuario que comparte este objeto o servicio')));
                    $this->elementStart('span', array('class' => 'add2cart'));
                    $this->elementStart('i', array('class' => 'glyphicon glyphicon-thumbs-up'));
                    $this->elementEnd('i');
                    $this->raw(_m('Responder'));
                    $this->elementEnd('span');                
                    $this->elementEnd('a'); 

                }

                $this->elementEnd('div');

            $this->elementEnd('div');
            $this->elementEnd('div');

            }


            $this->elementEnd('div');
            $this->elementEnd('div');



        /*
        $this->elementStart('div', array('class' => 'container main-container'));
        $this->elementStart('div', array('class' => 'row featuredPostContainer globalPadding style2'));

            $this->elementStart('h3', array('class' => 'section-title style2 text-center'));
            $this->elementStart('span');
            $this->raw(_m('Últimas ofertas y demandas'));
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
                $this->raw(_m('Ver'));
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
                $this->elementStart('a', array('href' => common_local_url('showsharings', array('id' => $sharing->id))));
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

                if (!empty($user and $user->getProfile()->id != $sharing->profile_id)) {

                    $form = new SharingsThemeResponseForm($sharing, $this);

                    $form->show();

                    $this->elementStart('a', array('class' => 'btn btn-primary', 'href' => '#', 'onclick' => 'document.getElementById("sharingresponse-form-' . $sharing->id . '").submit();' ));
                    $this->elementStart('span', array('class' => 'add2cart'));
                    $this->elementStart('i', array('class' => 'glyphicon glyphicon-thumbs-up'));
                    $this->elementEnd('i');
                    $this->raw(_m('Responder'));
                    $this->elementEnd('span');                
                    $this->elementEnd('a');        
                }

                $this->elementEnd('div');

            $this->elementEnd('div');
            $this->elementEnd('div');

            }

            $this->elementEnd('div');
            $this->elementEnd('div');

        $this->elementEnd('div');
        $this->elementEnd('div');
        */

        if (0 == $cnt) {
             $this->showEmptyListMessage();
        }

    }

}

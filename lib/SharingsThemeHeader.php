<?php

if (!defined('GNUSOCIAL')) { exit(1); }

class SharingsThemeHeader {

    static function showHeader($action) {

        $user = common_current_user();

        if (!empty($user)) {
            $nickname  = $user->getProfile()->getNickname();
        }

        $action->elementEnd('div');
        $action->elementStart('div', array('class' => 'navbar navbar-tshop navbar-fixed-top megamenu', 'role' => 'navigation'));

    $action->elementStart('div', array('class' => 'navbar-top'));
        $action->elementStart('div', array('class' => 'container'));
            $action->elementStart('div', array('class' => 'row'));
                $action->elementStart('div', array('class' => 'col-lg-6 col-sm-6 col-xs-6 col-md-6'));
                    $action->elementStart('div', array('class' => 'pull-left'));

                        $action->elementStart('ul', array('class' => 'userMenu'));

                            $action->elementStart('li');

                                $action->elementStart('a', array('href' => '#'));
                                $action->elementStart('span', array('class' => 'hidden-xs'));
                                $action->raw('Preguntas frecuentes');
                                $action->elementEnd('span');
                                $action->elementStart('i', array('class' => 'glyphicon glyphicon-info-sign hide visible-xs'));
                                $action->elementEnd('i');                              
                                $action->elementEnd('a');
                            $action->elementEnd('li');

                            $action->elementStart('li', array('class' => 'phone-number'));

                                $action->elementStart('a', array('href' => 'https://lamatriz.org/lamatriz'));

                                $action->elementStart('span');
                                $action->elementStart('i', array('class' => 'glyphicon glyphicon-user'));
                                $action->elementEnd('i');   

                                $action->elementEnd('span');

                                $action->elementStart('span', array('class' => 'hidden-xs', 'style' => 'margin-left:5px'));
                                $action->raw('@lamatriz@lamatriz.org');
                                $action->elementEnd('span');
                                $action->elementEnd('a');                            
                            $action->elementEnd('li');

                        $action->elementEnd('ul');

                    $action->elementEnd('div');
                $action->elementEnd('div');

                $action->elementStart('div', array('class' => 'col-lg-6 col-sm-6 col-xs-6 col-md-6 no-margin no-padding'));
                    $action->elementStart('div', array('class' => 'pull-right'));

                        $action->elementStart('ul', array('class' => 'userMenu'));

                        if (empty($user)) {

                            $action->elementStart('li');

                                $action->elementStart('a', array('href' => common_local_url('login')));
                                $action->elementStart('span', array('class' => 'hidden-xs'));
                                $action->raw(_('Login'));
                                $action->elementEnd('span');
                                $action->elementStart('i', array('class' => 'glyphicon glyphicon-user hide visible-xs'));
                                $action->elementEnd('i');                              
                                $action->elementEnd('a');
                            $action->elementEnd('li');

                        } else {

                            $action->elementStart('li', array('class' => 'dropdown hasUserMenu'));

                            $action->elementStart('a', array('href' => '#', 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));

                            $action->elementStart('i', array('class' => 'glyphicon glyphicon-log-in hide visible-xs'));
                            $action->elementEnd('i');
                            $action->raw(sprintf(_m('Hola, %s'), $user->getProfile()->fullname));
                            $action->elementStart('b', array('class' => 'caret'));
                            $action->elementEnd('b');
                            $action->elementEnd('a');

                            $action->elementStart('ul', array('class' => 'dropdown-menu'));

                                $action->elementStart('li');
                                $action->elementStart('a', array('href' => common_local_url('profilesettings')));
                                $action->elementStart('i', array('class' => 'fa fa fa-cog'));
                                $action->elementEnd('i');
                                $action->raw(_('Perfil'));

                                $action->elementEnd('a');

                                $action->elementEnd('li');

                                $action->elementStart('li', array('class' => 'divider'));
                                $action->elementEnd('li');

                                $action->elementStart('li');
                                $action->elementStart('a', array('href' => common_local_url('logout')));
                                $action->elementStart('i', array('class' => 'fa  fa-sign-out'));
                                $action->elementEnd('i');
                                $action->raw(_('Cerrar sesión'));
                                $action->elementEnd('a');
                                $action->elementEnd('li');
    
                            $action->elementEnd('ul');

                            $action->elementEnd('li');

                        }

                        $action->elementEnd('ul');

                    $action->elementEnd('div');
                $action->elementEnd('div');

            $action->elementEnd('div');
        $action->elementEnd('div');
    $action->elementEnd('div');

    $action->elementStart('div', array('class' => 'container'));

        $action->elementStart('div', array('class' => 'navbar-header'));

            $action->elementStart('button', array('class' => 'navbar-toggle', 'data-toggle' => 'collapse', 'data-target' => '.navbar-collapse'));

            $action->elementStart('span', array('class' => 'sr-only'));
            $action->raw('Toggle navigation');
            $action->elementEnd('span');
            $action->elementStart('span', array('class' => 'icon-bar'));
            $action->elementEnd('span');
            $action->elementStart('span', array('class' => 'icon-bar'));
            $action->elementEnd('span');
            $action->elementStart('span', array('class' => 'icon-bar'));
            $action->elementEnd('span');

            $action->elementEnd('button');

            $action->elementStart('button', array('class' => 'navbar-toggle', 'data-toggle' => 'collapse', 'data-target' => '.navbar-collapse'));

            $action->elementStart('i', array('class' => 'fa fa-shopping-cart colorWhite'));
            $action->elementEnd('i');
            $action->elementStart('span', array('class' => 'cartRespons colorWhite'));
            $action->raw('Cart ($210.00)');
            $action->elementEnd('span');

            $action->elementEnd('button');

            $action->elementStart('a', array('href' => common_local_url('all', array('nickname' => $nickname)), 'class' => 'navbar-brand'));

            $action->element('img', array('src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/logo.png'),
                                        'alt' => common_config('site', 'name')));

            $action->elementEnd('a');

        $action->elementEnd('div');

        $action->elementStart('div', array('class' => 'navbar-collapse collapse'));

            $action->elementStart('ul', array('class' => 'nav navbar-nav'));

                $action->elementStart('li', array('class' => 'active'));

                    $action->elementStart('a', array('href' => '#'));
                    $action->raw('Home');
                    $action->elementEnd('a');
                $action->elementEnd('li');

                $action->elementStart('li', array('class' => 'dropdown megamenu-fullwidth'));

                    $action->elementStart('a', array('href' => '#', 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'));
                    $action->raw('Bazar');
                    $action->elementStart('b', array('class' => 'caret'));
                    $action->elementEnd('b');
                    $action->elementEnd('a');
                    
            $action->elementStart('ul', array('class' => 'dropdown-menu'));

                $action->elementStart('li', array('class' => 'megamenu-content'));

                    $action->elementStart('ul', array('class' => 'col-lg-3  col-sm-3 col-md-3 unstyled noMarginLeft newCollectionUl'));

                    $action->elementStart('li', array('class' => 'no-border'));

                    $action->elementStart('p', array('class' => 'promo-1'));
                    $action->elementStart('strong');
                    $action->raw('Categorías');
                    $action->elementEnd('strong');
                    $action->elementEnd('p');
                    $action->elementEnd('li');

                    foreach($action->kategori as $key => $val) {
                        $action->elementStart('li');
                        $action->elementStart('a', array('href' => '#'));
                        $action->raw($val);
                        $action->elementEnd('a');
                        $action->elementEnd('li');

                    }


                    $action->elementEnd('ul');

                    $action->elementStart('ul', array('class' => 'col-lg-3  col-sm-3 col-md-3  col-xs-4'));

                        $action->elementStart('li');

                        $action->elementStart('a', array('class' => 'newProductMenuBlock', 'href' => '#'));

                        $action->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'),
                                        'alt' => 'Hospitalidad'));
                        $action->elementStart('span', array('class' => 'ProductMenuCaption'));

                        $action->elementStart('i', array('class' => 'fa fa-caret-right'));
                        $action->elementEnd('i');
                        $action->raw('Hospitalidad');    

                        $action->elementEnd('span');
                        $action->elementEnd('a');
                        $action->elementEnd('li');

                    $action->elementEnd('ul');

                    $action->elementStart('ul', array('class' => 'col-lg-3  col-sm-3 col-md-3  col-xs-4'));

                        $action->elementStart('li');

                        $action->elementStart('a', array('class' => 'newProductMenuBlock', 'href' => '#'));

                        $action->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'),
                                        'alt' => 'Servicios'));
                        $action->elementStart('span', array('class' => 'ProductMenuCaption'));

                        $action->elementStart('i', array('class' => 'fa fa-caret-right'));
                        $action->elementEnd('i');
                        $action->raw('Servicios');    

                        $action->elementEnd('span');
                        $action->elementEnd('a');
                        $action->elementEnd('li');

                    $action->elementEnd('ul');

                    $action->elementStart('ul', array('class' => 'col-lg-3  col-sm-3 col-md-3  col-xs-4'));

                        $action->elementStart('li');

                        $action->elementStart('a', array('class' => 'newProductMenuBlock', 'href' => '#'));

                        $action->element('img', array('class' => 'img-responsive', 'src' => SharingsThemePlugin::staticPath('SharingsTheme', 'images/sharings.png'),
                                        'alt' => 'Libros, Películas y Música'));
                        $action->elementStart('span', array('class' => 'ProductMenuCaption'));

                        $action->elementStart('i', array('class' => 'fa fa-caret-right'));
                        $action->elementEnd('i');
                        $action->raw('Libros, Películas y Música');    

                        $action->elementEnd('span');
                        $action->elementEnd('a');
                        $action->elementEnd('li');

                    $action->elementEnd('ul');


                $action->elementEnd('li');


            $action->elementEnd('ul');

       $action->elementStart('li', array('class' => 'dropdown megamenu-80width'));

                    $action->elementStart('a', array('href' => '#', 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'));
                    $action->raw('Conversación');
                    $action->elementStart('b', array('class' => 'caret'));
                    $action->elementEnd('b');
                    $action->elementEnd('a');

                    $action->elementStart('ul', array('class' => 'dropdown-menu'));
                    $action->elementStart('li', array('class' => 'megamenu-content'));

                    $action->elementStart('ul', array('class' => 'col-lg-2  col-sm-2 col-md-2  unstyled noMarginLeft'));

                    $action->elementStart('li');
                    $action->elementStart('p');
                    $action->elementStart('strong');
                    $action->raw('Conversaciones');
                    $action->elementEnd('strong');
                    $action->elementEnd('p');
                    $action->elementEnd('li');

                        $action->elementStart('li');
                        try {
                            $action->elementStart('a', array('href' => common_local_url('hederoposts')));
                        } catch (Exception $e) {
                            $action->elementStart('a', array('href' => common_local_url('qvitter')));
                        }
                        $action->raw('Posts asociados');
                        $action->elementEnd('a');
                        $action->elementEnd('li');

                        if (!empty($user)) {
                            $action->elementStart('li');
                            $action->elementStart('a', array('href' => common_local_url('all', array('nickname' => $nickname))));
                            $action->raw('Línea temporal');
                            $action->elementEnd('a');
                            $action->elementEnd('li');
                        }

                        $action->elementStart('li');
                        $action->elementStart('a', array('href' => common_local_url('public')));
                        $action->raw('Línea temporal pública');
                        $action->elementEnd('a');
                        $action->elementEnd('li');

                        $action->elementStart('li');
                        $action->elementStart('a', array('href' => common_local_url('networkpublic')));
                        $action->raw('Toda la red conocida');
                        $action->elementEnd('a');
                        $action->elementEnd('li');

                    $action->elementEnd('ul');
                    $action->elementEnd('li');

        $action->elementEnd('li');

    $action->elementEnd('div');

$action->elementEnd('div');

$action->elementEnd('div');

        $action->elementStart('div', array('class' => 'nav navbar-nav navbar-right hidden-xs'));

        $action->elementStart('div', array('class' => 'search-box'));

            $action->elementStart('div', array('class' => 'input-group'));
            $action->elementStart('button', array('class' => 'btn btn-nobg getFullSearch', 'type' => 'button'));
            $action->elementStart('i', array('class' => 'fa fa-search'));
            $action->elementEnd('i');
            $action->elementEnd('button');
            $action->elementEnd('div');

        $action->elementEnd('div');
    
        $action->elementEnd('div');

        $action->elementEnd('div');

        $action->elementEnd('div');

        $action->elementEnd('div');


    }
}

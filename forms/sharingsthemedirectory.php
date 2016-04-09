<?php
/**
 * StatusNet - the distributed open-source microblogging tool
 * Copyright (C) 2011, StatusNet, Inc.
 *
 * Form for adding a new poll
 *
 * PHP version 5
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  PollPlugin
 * @package   StatusNet
 * @author    Brion Vibber <brion@status.net>
 * @copyright 2011 StatusNet, Inc.
 * @license   http://www.fsf.org/licensing/licenses/agpl-3.0.html AGPL 3.0
 * @link      http://status.net/
 */

if (!defined('STATUSNET')) {
    // This check helps protect against security problems;
    // your code file can't be executed directly from the web.
    exit(1);
}

/**
 * Form to add a new poll thingy
 *
 * @category  PollPlugin
 * @package   StatusNet
 * @author    Brion Vibber <brion@status.net>
 * @copyright 2011 StatusNet, Inc.
 * @license   http://www.fsf.org/licensing/licenses/agpl-3.0.html AGPL 3.0
 * @link      http://status.net/
 */
class SharingsThemeDirectoryForm extends Form
{

    /**
     * Construct a new poll form
     *
     * @param Poll $poll
     * @param HTMLOutputter $out         output channel
     *
     * @return void
     */
    function __construct(HTMLOutputter $out)
    {
        parent::__construct($out);

        $kategori = new Sharing_category();

        $kategori->find();

        $this->kategori[0] = _m('Todas');

        while ($kategori->fetch()) {
            $this->kategori[$kategori->id] = _m(sprintf('%s', $kategori->name));
        }

        $urbi = new Sharing_city();

        $urbi->orderBy('name ASC');

        $urbi->find();

        $this->urbi[0] = _m('Todas');

        while ($urbi->fetch()) {
            $this->urbi[$urbi->id] = $urbi->name;
        }

        $tipi = new Sharing_type();

        $this->tipi[0] = _m('Todos');

        $tipi->find();

        while ($tipi->fetch()) {
            $this->tipi[$tipi->id] = _m(sprintf('%s', $tipi->name));
        }
    }

    /**
     * ID of the form
     *
     * @return int ID of the form
     */
    function id()
    {
        return 'sharingsdirectory-form';
    }

    /**
     * class of the form
     *
     * @return string class of the form
     */
    function formClass()
    {
        return 'form_sharings_theme_directory';
    }

    /**
     * Action of the form
     *
     * @return string URL of the action
     */
    function action()
    {
        common_local_url('sharingsdirectory');
    }

    /**
     * Data elements of the form
     *
     * @return void
     */
    function formData()
    {

        $this->elementStart('div', array('class' => 'row'));

        $this->elementStart('div', array('class' => 'col-lg-3 col-md-3 col-sm-12'));


        $this->elementStart('div', array('class' => 'panel-group', 'id' => 'accordionNo'));

        $this->elementStart('div', array('class' => 'panel panel-default'));

        $this->elementStart('div', array('class' => 'panel-heading'));

        $this->elementStart('h4', array('class' => 'panel-title'));

        $this->elementStart('a', array('href' => '#collapsePc', 'data-toggle' => 'collapse', 'class' => 'collapseWill active'));

        $this->elementStart('span', array('class' => 'pull-left'));

        $this->element('i', array('class' => 'fa fa-caret-right'));

        $this->elementEnd('span');
        $this->raw(_m('Palabra clave'));
        $this->elementEnd('a');
        $this->elementEnd('h4');

        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'panel-collapse collapse in', 'id' => 'collapsePc'));

        $this->elementStart('div', array('class' => 'panel-body'));

        $this->elementStart('div', array('class' => 'form-group'));

        $this->element('input', array('name' => 'pc', 'class' => 'form-control', 'value' => $this->out->pc));

        $this->elementEnd('div');

        $this->elementStart('button', array('class' => 'btn btn-default pull-left', 'type' => 'sumit'));
        $this->raw(_m('Buscar'));
        $this->elementEnd('button');


        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');




        $this->elementStart('div', array('class' => 'panel-group', 'id' => 'accordionNo'));

        $this->elementStart('div', array('class' => 'panel panel-default'));

        $this->elementStart('div', array('class' => 'panel-heading'));

        $this->elementStart('h4', array('class' => 'panel-title'));

        $this->elementStart('a', array('href' => '#collapseCategory', 'data-toggle' => 'collapse', 'class' => 'collapseWill active'));

        $this->elementStart('span', array('class' => 'pull-left'));

        $this->element('i', array('class' => 'fa fa-caret-right'));

        $this->elementEnd('span');
        $this->raw(_m('Categoría'));
        $this->elementEnd('a');
        $this->elementEnd('h4');

        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'panel-collapse collapse in', 'id' => 'collapseCategory'));

        $this->elementStart('div', array('class' => 'panel-body'));

        $this->out->elementStart('select', array('name' => 'sharing_category_id', 'class' => 'form-control', 'onchange' => 'document.getElementById("sharingsdirectory-form").submit();'));

        foreach ($this->kategori as $value => $option) {
            if ($value == $this->out->sharing_category_id) {
                $this->out->element('option', array('value' => $value,
                                               'selected' => 'selected'),
                               $option);
            } else {
                $this->out->element('option', array('value' => $value), $option);
            }
        }
        $this->out->elementEnd('select');
        
        $this->out->element('p', 'form_guide', _m('Explora el catálogo por categorías'));

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');


        $this->elementStart('div', array('class' => 'panel-group', 'id' => 'accordionNo'));

        $this->elementStart('div', array('class' => 'panel panel-default'));

        $this->elementStart('div', array('class' => 'panel-heading'));

        $this->elementStart('h4', array('class' => 'panel-title'));

        $this->elementStart('a', array('href' => '#collapseType', 'data-toggle' => 'collapse', 'class' => 'collapseWill active'));

        $this->elementStart('span', array('class' => 'pull-left'));

        $this->element('i', array('class' => 'fa fa-caret-right'));

        $this->elementEnd('span');
        $this->raw(_m('Tipo'));
        $this->elementEnd('a');
        $this->elementEnd('h4');

        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'panel-collapse collapse in', 'id' => 'collapseType'));

        $this->elementStart('div', array('class' => 'panel-body'));

        $this->out->elementStart('select', array('name' => 'sharing_type_id', 'class' => 'form-control', 'onchange' => 'document.getElementById("sharingsdirectory-form").submit();'));

        foreach ($this->tipi as $value => $option) {
            if ($value == $this->out->sharing_type_id) {
                $this->out->element('option', array('value' => $value,
                                               'selected' => 'selected'),
                               $option);
            } else {
                $this->out->element('option', array('value' => $value), $option);
            }
        }
        $this->out->elementEnd('select');
        
        $this->out->element('p', 'form_guide', _m('Explora el catálogo por tipo de publicación'));

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');


        $this->elementStart('div', array('class' => 'panel-group', 'id' => 'accordionNo'));

        $this->elementStart('div', array('class' => 'panel panel-default'));

        $this->elementStart('div', array('class' => 'panel-heading'));

        $this->elementStart('h4', array('class' => 'panel-title'));

        $this->elementStart('a', array('href' => '#collapseCity', 'data-toggle' => 'collapse', 'class' => 'collapseWill active'));

        $this->elementStart('span', array('class' => 'pull-left'));

        $this->element('i', array('class' => 'fa fa-caret-right'));

        $this->elementEnd('span');
        $this->raw(_m('Ciudad'));
        $this->elementEnd('a');
        $this->elementEnd('h4');

        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'panel-collapse collapse in', 'id' => 'collapseCity'));

        $this->elementStart('div', array('class' => 'panel-body'));

        $this->out->elementStart('select', array('name' => 'sharing_city_id', 'class' => 'form-control', 'onchange' => 'document.getElementById("sharingsdirectory-form").submit();'));

        foreach ($this->urbi as $value => $option) {
            if ($value == $this->out->sharing_city_id) {
                $this->out->element('option', array('value' => $value,
                                               'selected' => 'selected'),
                               $option);
            } else {
                $this->out->element('option', array('value' => $value), $option);
            }
        }
        $this->out->elementEnd('select');
        
        $this->out->element('p', 'form_guide', _m('Explora el catálogo por ciudades'));

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');


        $this->elementStart('div', array('class' => 'panel-group', 'id' => 'accordionNo'));

        $this->elementStart('div', array('class' => 'panel panel-default'));

        $this->elementStart('div', array('class' => 'panel-heading'));

        $this->elementStart('h4', array('class' => 'panel-title'));

        $this->elementStart('a', array('href' => '#collapsePrice', 'data-toggle' => 'collapse', 'class' => 'collapseWill active'));

        $this->elementStart('span', array('class' => 'pull-left'));

        $this->element('i', array('class' => 'fa fa-caret-right'));

        $this->elementEnd('span');
        $this->raw(_m('Precio'));
        $this->elementEnd('a');
        $this->elementEnd('h4');

        $this->elementEnd('div');

        $this->elementStart('div', array('class' => 'panel-collapse collapse in', 'id' => 'collapsePrice'));

        $this->elementStart('div', array('class' => 'panel-body'));

        $this->elementStart('div', array('class' => 'block-element'));

        $this->elementStart('span');

        if($this->out->gratuito == true) {
            $this->elementStart('input', array('type' => 'checkbox', 'name' => 'gratuito', 'id' => 'gratuito', 'checked' => 'checked'));
        } else {
             $this->elementStart('input', array('type' => 'checkbox', 'name' => 'gratuito', 'id' => 'gratuito'));
        }
        
        $this->raw(_m('Mostrar sólo los intercambios de forma gratuita'));
        $this->elementEnd('span');


        $this->elementEnd('div');


        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');


        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');
        $this->elementEnd('div');

        $this->elementEnd('div');


    }

    /**
     * Action elements
     *
     * @return void
     */
    function formActions()
    {

    }
}

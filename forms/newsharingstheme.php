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
class NewSharingsThemeForm extends Form
{
    protected $sharing_category_id = null;
    protected $sharing_type_id = null;
    protected $sharing_city_id = null;
    protected $displayName    = null;
    protected $summary     = null;
    protected $price    = null;

    protected $kategori = array();
    protected $urbi = array();
    protected $tipi = array();


    /**
     * Construct a new poll form
     *
     * @param HTMLOutputter $out         output channel
     *
     * @return void
     */
    function __construct($out=null, $displayName=null, $summary=null, $price=null, $sharing_category_id=null,
                         $sharing_type_id=null, $sharing_city_id=null)
    {
        parent::__construct($out);

        $this->displayName = $displayName;
        $this->summary = $summary;
        $this->price = $price;
        $this->sharing_category_id = $sharing_category_id;
        $this->sharing_type_id = $sharing_type_id;
        $this->sharing_city_id = $sharing_city_id;

        $kategori = new Sharing_category();

        $kategori->find();

        $this->kategori[0] = _m('Selecciona una categoría');

        while ($kategori->fetch()) {
            $this->kategori[$kategori->id] = _m(sprintf('%s', $kategori->name));
        }

        $urbi = new Sharing_city();

        $urbi->orderBy('name ASC');

        $urbi->find();

        $this->urbi[0] = _m('Selecciona una ciudad');

        while ($urbi->fetch()) {
            $this->urbi[$urbi->id] = $urbi->name;
        }

        $tipi = new Sharing_type();

        $this->tipi[0] = _m('Selecciona Oferta o Demanda');

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
        return 'newsharings-form';
    }

    /**
     * class of the form
     *
     * @return string class of the form
     */
    function formClass()
    {
        return 'regForm';
    }

    /**
     * Action of the form
     *
     * @return string URL of the action
     */
    function action()
    {
        return common_local_url('newsharings');
    }

    function show()
    {
        $attributes = array('id' => $this->id(),
            'class' => $this->formClass(),
            'method' => $this->method(),
            'action' => $this->action());

        if (!empty($this->enctype)) {
            $attributes['enctype'] = $this->enctype;
        }
        $this->out->elementStart('form', $attributes);

        $this->formLegend();
        $this->sessionToken();
        $this->formData();
        $this->formActions();

        $this->out->elementEnd('form');
    }

    /**
     * Data elements of the form
     *
     * @return void
     */
    function formData()
    {


        $this->out->elementStart('div', array('class' => 'col-xs-12 col-sm-6'));

        $this->out->elementStart('div', array('class' => 'form-group'));

        $this->out->input('displayName',
                          // TRANS: Field label on the page to create a poll.
                          _m('Nombre'),
                          $this->displayName,
                          // TRANS: Field title on the page to create a poll.
                          _m('Nombre del objeto o servicio a compartir'),
                          'displayName',
                          true, array('class' => 'form-control'));    // HTML5 "required" attribute

        $this->out->elementEnd('div');

        $this->out->elementStart('div', array('class' => 'form-group'));

        $this->out->elementStart('label', array('for' => 'summary'));
        $this->raw(_m('Detalle'));
        $this->out->elementEnd('label');

        $this->out->element('textarea', array('rows' => '3', 'cols' => '26', 'name' => 'summary', 'class' => 'form-control'), $this->summary);

        $this->out->element('p', 'form_guide', _m('Detalle del objeto o servicio que se quiere compartir'));

        $this->out->elementEnd('div');

        $this->out->elementStart('div', array('class' => 'form-group'));

        $this->out->input('price',
                          // TRANS: Field label for an answer option on the page to create a poll.
                          // TRANS: %d is the option number.
                          _m('Precio'),
                          $this->price,
                          _m('Indica el precio asociado a este producto o servicio. Asignale 0 - cero - en caso de querer compartirlo de forma gratuita'),
                          'price',
                          true, array('class' => 'form-control'));

        $this->out->elementEnd('div');


        $this->out->elementEnd('div');

        $this->out->elementStart('div', array('class' => 'col-xs-12 col-sm-6'));

        $this->out->elementStart('div', array('class' => 'form-group'));

        $this->out->element('label', array('for' => 'sharing_category_id'), _m('Categoría'));

        $this->out->elementStart('select', array('name' => 'sharing_category_id', 'class' => 'form-control'));

        foreach ($this->kategori as $value => $option) {
            if ($value == 0) {
                $this->out->element('option', array('value' => $value,
                                               'selected' => 'selected'),
                               $option);
            } else {
                $this->out->element('option', array('value' => $value), $option);
            }
        }
        $this->out->elementEnd('select');
        
        $this->out->element('p', 'form_guide', _m('Por favor, selecciona la categoría en la que quieres publicar'));

        $this->out->elementEnd('div');

        $this->out->elementStart('div', array('class' => 'form-group'));

        $this->out->element('label', array('for' => 'sharing_type_id'), _m('Tipo'));

        $this->out->elementStart('select', array('name' => 'sharing_type_id', 'class' => 'form-control'));

        foreach ($this->tipi as $value => $option) {
            if ($value == 0) {
                $this->out->element('option', array('value' => $value,
                                               'selected' => 'selected'),
                               $option);
            } else {
                $this->out->element('option', array('value' => $value), $option);
            }
        }
        $this->out->elementEnd('select');
        
        $this->out->element('p', 'form_guide', _m('Por favor, indica si estas publicando una oferta o una demanda'));

        $this->out->elementEnd('div');


        $this->out->elementStart('div', array('class' => 'form-group'));

        $this->out->element('label', array('for' => 'sharing_city_id'), _m('Ciudad'));

        $this->out->elementStart('select', array('name' => 'sharing_city_id', 'class' => 'form-control'));

        foreach ($this->urbi as $value => $option) {
            if ($value == 0) {
                $this->out->element('option', array('value' => $value,
                                               'selected' => 'selected'),
                               $option);
            } else {
                $this->out->element('option', array('value' => $value), $option);
            }
        }
        $this->out->elementEnd('select');
        
        $this->out->element('p', 'form_guide', _m('Por favor, selecciona una ciudad. Si tu ciudad no está en el listado puedes no indicar la ciudad ahora, agregar el objeto o servicio y pedir añadir tu ciudad en http://git.lasindias.club/manuel/Sharings/issues'));

        $this->out->elementEnd('div');


        //$toWidget = new ToSelector($this->out,
        //                           common_current_user(),
        //                           null);
        //$toWidget->show();

        $this->out->elementStart('a', array('class' => 'btn btn-primary', 'onclick' => 'document.getElementById("newsharings-form").submit();'));
        $this->out->elementStart('i', array('class' => 'fa fa-sign-in'));
        $this->out->elementEnd('i');
        $this->raw(_m('Compartir'));
        $this->out->elementEnd('a');

        $this->out->elementEnd('div');

    }

    /**
     * Action elements
     *
     * @return void
     */
    function formActions()
    {
        // TRANS: Button text for saving a new poll.
        //$this->out->submit('btn btn-primary', _m('BUTTON', 'Compartir'), 'submit', 'submit');
    }
}

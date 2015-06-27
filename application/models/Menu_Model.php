<?php

class Menu_Model extends CI_Model {

    protected $table = 'menus';
    public $html;

    /**
     * Construtor da classe
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helpers(['url']);

        $this->db->order_by('menu');
        $resultado = $this->db->get_where($this->table);
        $menus = array();

        foreach( $resultado->result('array') as $dados ){
            $menus[$dados['menu_id']][$dados['id']] = $dados;
        }
        $this->menu($menus);
    }

    /**
     * Fuction to create menu
     *
     * @param array $menus
     * @param null $menu_id
     */
    private function menu(array $menus, $menu_id = null, $sub = false){
        if( $menu_id ) $this->html .= '<ul class="dropdown-menu" role="menu">' . PHP_EOL;

        foreach ( $menus[$menu_id] as $id => $menu ){
            $class = ( strstr($this->uri->uri_string(), $menu['link']) ) ? "active" : "";
            if( isset($menus[$id]) and !empty($menu['link']) ){

                $this->html .= '<li class="dropdown '.$class.'">' . anchor($menu['link'], $menu['menu'], array('class'=>"dropdown-toggle",
                        'data-toggle'=>'dropdown', 'role'=>'button', 'aria-expanded'=>'false')) . PHP_EOL;
                $this->menu($menus, $id, true);
            } else {
                if( $sub === true ){
                    $class = ( $menu['link'] == $this->uri->uri_string() ) ? "active" : "";
                }
                $this->html .= '<li class="'.$class.'">' . anchor($menu['link'], $menu['menu']);
            }

            $this->html .= '</li>' . PHP_EOL;
        }

        if( $menu_id ) $this->html .= '</ul>' . PHP_EOL;
    }


}
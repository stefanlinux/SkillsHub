<?php
class Opdrachtgever extends User {

  private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;

  public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');
    }

    public function create_markt($fields = array()) {
        if(!$this->_db->insert('markt', $fields)) {
            throw new Exception('Er was een probleem met het creeren van een opdrachtgever in de markt.');
        }
    }

      public function create_opdrachtgever($fields = array()) {
        if(!$this->_db->insert('opdrachtgevers', $fields)) {
            throw new Exception('Er was een probleem met het creeren van een opdrachtgever in de opdrachtgevers.');
        }
      }

     public function create_contactpersoon($fields = array()) {
        if(!$this->_db->insert('contactpersonen', $fields)) {
            throw new Exception('Er was een probleem met het creeren van een contactpersoon.');
        }
      }
    


    
}

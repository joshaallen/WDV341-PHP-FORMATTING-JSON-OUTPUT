<?php 
require_once('connection.php');
/*
    An event that can be changed by name, description, presenter and the date and time the event occured
*/
class Event {
    //Properties

    //instance field created to store connection class instatiation
    private $event_conn;
    private $eventName;
    private $eventDescription;
    private $eventPresenter;
    private $eventDate;
    private $eventTime;

    /**
     * Constructor will always create a connection object to be used, but
     * will not open the connection at instantiation
     */
    function __construct() {
        $this->event_conn = new Connection();
    }

    //Mutator Methods
    /**
     * Sets the event name
     * @param $name is the name of the event
     */
    function set_eventName($name) {
        $this->eventName = $name;
    }
    /**
     * Sets the event description
     * @param $description is the descriptio nof the event
     */
    function set_eventDescription($description) {
        $this->eventDescription = $description;
    }
    /**
     * Sets the who is presenting the event
     * @param $presenter is presenter of the event
     */
    function set_eventPresenter($presenter){
        $this->eventPresenter = $presenter;
    }
    /**
     * Sets the date of the event
     * @param $date is the date of the event
     */
    function set_eventDate($date){
        $this->eventDate = $date;
    }
    /**
     * Sets the time of the event
     * @param $time is time of the event
     */
    function set_eventTime($time) {
        $this->eventTime = $time;
    }
    //Accessor Methods
    /**
     * This gets the event name
     * @return $eventName the name of the event
     */
    function get_eventName() {
        return $this->eventName;
    }
     /**
     * This gets the event description
     * @return $eventDescription the description of the event
     */
    function get_eventDescription() {
        return $this->eventDescription;
    }
     /**
     * This gets the presenter of the event
     * @return $eventPresenter the presenter of the event
     */
    function get_eventPresenter() {
        return $this->eventPresenter;
    }
     /**
     * This gets the event date
     * @return $eventDate the date of the event
     */
    function get_eventDate() {
        return $this->eventDate;
    }
     /**
     * This gets the event time 
     * @return $eventTime the time of the event
     */
    function get_eventTime() {
        return $this->eventTime;
    }
    /**
     * 
     * Get events from the DB based on a passed in query and optional arguments
     * @param string $query Query string to be sent with PDO
     * @param array $values Optional Array containing key/value pair arrays to be bound to PDO statement
     * @return $results Fetched DB results
     */
    public function get_events($query, $values = array()) {
        $conn = $this->event_conn->open();
        $statement_obj = $conn->prepare($query);

        /**
         * If bind values are sent, then bind them to the query parameters
         * array( 
         *      array(':presenter', 'Bob'), 
         *      array(':name', 'Cooking') 
         * )
         */
        if($values) {
            foreach($values as $value) {
                $statement_obj->bindValue($value[0], $value[1]);
            }
        }

        /**
         * Execute, fetch and close the connection
         */
        $statement_obj->execute();
        $results = $statement_obj->fetchAll(PDO::FETCH_ASSOC);
        $conn = $this->event_conn->close();
        
        return $results;
    }

    /** 
    * Get event from the DB based on a passed in query
     * @param string $query Query string to be sent with PDO
     * @return $result Fetched DB results
     */
    public function get_Event($query) {
        $conn = $this->event_conn->open();
        $statement_obj = $conn->prepare($query);
        $statement_obj->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);    
        $conn = $this->event_conn->close();
    }
}
?>
<?php /* TODO: maybe make this a framework object? and let warehousing, sales, purchase extend this */
namespace Modules\Warehousing {
    /**
     * Article class
     *
     * PHP Version 5.4
     *
     * @category   Warehousing
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Article implements \Framework\Object\ObjectInterface, \Framework\Pattern\Multition {
        /**
         * Article ID
         *
         * @var int
         * @since 1.0.0
         */
        private $id = null;

        /**
         * Name
         *
         * @var string
         * @since 1.0.0
         */
        private $name = '';

        /**
         * Description
         *
         * @var string
         * @since 1.0.0
         */
        private $description = '';

        /**
         * Matchcode
         *
         * @var string
         * @since 1.0.0
         */
        private $matchcode = '';

        /**
         * Sector
         *
         * @var string
         * @since 1.0.0
         */
        private $sector = null;

        /**
         * Group
         *
         * @var string
         * @since 1.0.0
         */
        private $group = null;

        /**
         * Suppliers
         *
         * supplier price leadtime
         *
         * @var string
         * @since 1.0.0
         */
        private $suppliers = null;

        /**
         * Localization strings
         *
         * [en] Name - Description
         *
         * @var array
         * @since 1.0.0
         */
        private $invoice_i18n = [];

        /**
         * Prizes
         *
         * [id] name country state prize discount% discountA bonus-in-kind groupA groupB amount event
         *
         * @var array
         * @since 1.0.0
         */
        private $prizes = [];

        /**
         * Active supplier
         *
         * @var string
         * @since 1.0.0
         */
        private $pprice = null;

        /**
         * Created
         *
         * @var \Datetime
         * @since 1.0.0
         */
        private $created = null;

        /**
         * Creator
         *
         * @var \Framework\Object\User
         * @since 1.0.0
         */
        private $creator = null;

        /**
         * Article
         *
         * @var \Modules\Warehousing\Article[]
         * @since 1.0.0
         */
        private static $instances = [];

        /**
         * Constructor
         *
         * @param int $id Article ID
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id) {
            $this->id = $id;
        }

        /**
         * {@inheritdoc}
         */
        public function __clone() {
        }

        /**
         * Initializing object
         *
         * @param int $id Article ID
         *
         * @return \Modules\Warehousing\Article
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getInstance($id) {
            if(!isset(self::$instances[$id])) {
                self::$instances[$id] = new self($id);
            }

            return self::$instances[$id];
        }

        /**
         * Get ID
         *
         * @return int
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getID() {
            return $this->id;
        }

        /**
         * Get name
         *
         * @return string
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getName() {
            return $this->name;
        }

        /**
         * Set name
         *
         * @param string $name Name of the article
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setName($name) {
            $this->name = $name;
        }

        /**
         * Get matchcode
         *
         * @return string
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getMatchcode() {
            return $this->matchcode;
        }

        /**
         * Set matchcode
         *
         * @param string $matchcode Matchcode of the article
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setMatchcode($matchcode) {
            $this->matchcode = $matchcode;
        }

        /**
         * Get description
         *
         * @return string
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getDescription() {
            return $this->description;
        }

        /**
         * Set description
         *
         * @param string $description Description of the article
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setDescription($desc) {
            $this->description = $desc;
        }

        /**
         * Get created
         *
         * @return \Datetime
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCreated() {
            return $this->created;
        }

        /**
         * Set created
         *
         * @param \Datetime $created Date of when the article got created
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCreated($created) {
            $this->created = $created;
        }

        /**
         * Get creator
         *
         * @return \Framework\Object\User
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCreator() {
            return $this->creator;
        }

        /**
         * Set creator
         *
         * @param \Framework\Object\User $creator Creator ID
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCreator($creator) {
            $this->creator = $creator;
        }

        /**
         * Add price to pricelist
         *
         * @param array $price Price
         * @param bool $db Update DB and cache?
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function addPrice($price, $db = true) {
            $id = 0; /* insert and get id */
            $this->prices[$id] = $price;
        }

        /**
         * Remove price from pricelist
         *
         * @param int $id Price ID
         * @param bool $db Update DB and cache?
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function removePrice($id, $db = true) {
            if(isset($this->prices[$id])) {
                unset($this->prices[$id]);
            }
        }

        /**
         * Add price to pricelist
         *
         * @param int $id Price ID
         * @param array $price Price
         * @param bool $db Update DB and cache?
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function editPrice($id, $price, $db = true) {
            if(isset($this->prices[$id])) {
                $this->prices[$id] = $price;
            }
        }

        /**
         * {@inheritdoc}
         */
        public function delete() {

        }

        /**
         * {@inheritdoc}
         */
        public function create() {

        }

        /**
         * {@inheritdoc}
         */
        public function update() {

        }

        /**
         * {@inheritdoc}
         */
        public function serialize() {

        }

        /**
         * {@inheritdoc}
         */
        public function unserialize($data) {

        }
    }
}
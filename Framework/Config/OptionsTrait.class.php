<?php
trait OptionsTrait {
    /**
     * Options
     *
     * @var array
     * @since 1.0.0
     */
    private $options = [];

    /**
     * {@inheritdoc}
     */
    public function getOption($key) {
        return (isset($this->options[$key]) ? $this->options[$key] : null);
    }

    /**
     * {@inheritdoc}
     */
    public function setOption($key, $value, $storable = false, $save = false) {
        $this->options[$key] = [$value, $storable];

        if($save) {
            // TODO: save to db and or caching
        }
    }
}
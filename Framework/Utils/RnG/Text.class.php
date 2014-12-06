<?php
namespace Framework\Utils\RnG {
    /**
     * Text generator
     *
     * PHP Version 5.4
     *
     * @category   DataStorage
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Text {
        /**
         * Vocabulary
         *
         * @var string[]
         * @since 1.0.0
         */
        public static $words_west = ['lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit', 'curabitur', 'vel', 'hendrerit', 'libero', 'eleifend', 'blandit', 'nunc', 'ornare', 'odio', 'ut', 'orci', 'gravida', 'imperdiet', 'nullam', 'purus', 'lacinia', 'a', 'pretium', 'quis', 'congue', 'praesent', 'sagittis', 'laoreet', 'auctor', 'mauris', 'non', 'velit', 'eros', 'dictum', 'proin', 'accumsan', 'sapien', 'nec', 'massa', 'volutpat', 'venenatis', 'sed', 'eu', 'molestie', 'lacus', 'quisque', 'porttitor', 'ligula', 'dui', 'mollis', 'tempus', 'at', 'magna', 'vestibulum', 'turpis', 'ac', 'diam', 'tincidunt', 'id', 'condimentum', 'enim', 'sodales', 'in', 'hac', 'habitasse', 'platea', 'dictumst', 'aenean', 'neque', 'fusce', 'augue', 'leo', 'eget', 'semper', 'mattis', 'tortor', 'scelerisque', 'nulla', 'interdum', 'tellus', 'malesuada', 'rhoncus', 'porta', 'sem', 'aliquet', 'et', 'nam', 'suspendisse', 'potenti', 'vivamus', 'luctus', 'fringilla', 'erat', 'donec', 'justo', 'vehicula', 'ultricies', 'varius', 'ante', 'primis', 'faucibus', 'ultrices', 'posuere', 'cubilia', 'curae', 'etiam', 'cursus', 'aliquam', 'quam', 'dapibus', 'nisl', 'feugiat', 'egestas', 'class', 'aptent', 'taciti', 'sociosqu', 'ad', 'litora', 'torquent', 'per', 'conubia', 'nostra', 'inceptos', 'himenaeos', 'phasellus', 'nibh', 'pulvinar', 'vitae', 'urna', 'iaculis', 'lobortis', 'nisi', 'viverra', 'arcu', 'morbi', 'pellentesque', 'metus', 'commodo', 'ut', 'facilisis', 'felis', 'tristique', 'ullamcorper', 'placerat', 'aenean', 'convallis', 'sollicitudin', 'integer', 'rutrum', 'duis', 'est', 'etiam', 'bibendum', 'donec', 'pharetra', 'vulputate', 'maecenas', 'mi', 'fermentum', 'consequat', 'suscipit', 'aliquam', 'habitant', 'senectus', 'netus', 'fames', 'quisque', 'euismod', 'curabitur', 'lectus', 'elementum', 'tempor', 'risus', 'cras'];

        /**
         * Get a random string
         *
         * @param int $length Text length
         * @param int $words  Vocabulary
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generateText($length, $words = null) {
            if($words === null) {
                $words = self::$words_west;
            }

            $punctuation       = self::generatePunctuation($length);
            $punctuation_count = ['.' => 0, '!' => 0, '?' => '?'];
            $punctuation_count = array_count_values(
                                     array_map(
                                         function ($item) {
                                             return $item[1];
                                         },
                                         $punctuation
                                     )
                                 ) + $punctuation_count;

            $paragraph = self::generateParagraph($punctuation_count['.'] + $punctuation_count['!'] + $punctuation_count['?']);

            $sentence_count = 0;
            $text           = '';
            $pid            = 0;
            $paid           = 0;
            $i              = 0;
            $count          = count($words);

            while($i < $length + 1) {
                $new_sentence = false;

                $last = substr($text, -1);

                if($last === '.' || $last === '!' || $last === '?' || !$last) {
                    $new_sentence = true;
                }

                $word = $words[rand(0, $count - 1)];

                if($new_sentence) {
                    $word = ucfirst($word);
                    $sentence_count++;

                    if($sentence_count === $paragraph[$paid]) {
                        $paid++;
                        $text .= '</p><p>';
                    }
                }

                $text .= ' ' . $word;

                if($punctuation[$pid][0] === $i) {
                    $text .= $punctuation[$pid][1];
                    $pid++;
                }

                $i++;
            }

            return '<p>' . ltrim($text) . '</p>';
        }

        private static function generatePunctuation($length) {
            $min_sentence      = 4;
            $max_sentence      = 20;
            $min_comma_spacing = 3;
            $comma_prob        = 0.2;
            $dot_prob          = 0.8;
            $ex_prob           = 0.4;

            $punctuation = [];
            $i           = 0;

            while($length > 0) {
                $sentence_length = rand($min_sentence, $max_sentence);

                if($sentence_length > $length || $length - $sentence_length < $min_sentence) {
                    $sentence_length = $length;
                }

                $length -= $sentence_length;
                $i += $sentence_length;

                $comma_here = (rand(0, 100) <= $comma_prob * 100 && $sentence_length >= 2 * $min_comma_spacing ? true : false);
                $comma_pos  = [];

                if($comma_here) {
                    $comma_pos[]   = rand($min_comma_spacing, $sentence_length - $min_comma_spacing);
                    $punctuation[] = [$i - $sentence_length + $comma_pos[0], ','];

                    $comma_here = (rand(0, 100) <= $comma_prob * 100 && $comma_pos[0] + $min_comma_spacing * 2 < $sentence_length ? true : false);

                    if($comma_here) {
                        $comma_pos[]   = rand($comma_pos[0] + $min_comma_spacing, $sentence_length - $min_comma_spacing);
                        $punctuation[] = [$i - $sentence_length + $comma_pos[1], ','];
                    }
                }

                $is_dot = (rand(0, 100) <= $dot_prob * 100 ? true : false);

                if($is_dot) {
                    $punctuation[] = [$i, '.'];
                    continue;
                }

                $is_ex = (rand(0, 100) <= $ex_prob * 100 ? true : false);

                if($is_ex) {
                    $punctuation[] = [$i, '!'];
                    continue;
                }

                $punctuation[] = [$i, '?'];
            }

            return $punctuation;
        }

        private static function generateParagraph($length) {
            $min_sentence = 3;
            $max_sentence = 10;

            $paragraph = [];
            $i         = 0;

            while($length > 0) {
                $paragraph_length = rand($min_sentence, $max_sentence);

                if($paragraph_length > $length || $length - $paragraph_length < $min_sentence) {
                    $paragraph_length = $length + 1;
                }

                $length -= $paragraph_length;
                $i += $paragraph_length;

                $paragraph[] = $i;
            }

            return $paragraph;
        }
    }
}


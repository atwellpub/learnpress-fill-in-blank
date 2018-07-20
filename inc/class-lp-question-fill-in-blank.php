<?php
/**
 * Question fill in blank question class.
 *
 * @author   ThimPress
 * @package  LearnPress/Fill-In-Blank/Classes
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Question_Fill_In_Blank' ) ) {

	/**
	 * Class LP_Question_Fill_In_Blank
	 */
	class LP_Question_Fill_In_Blank extends LP_Question {

		/**
		 * @var string
		 */
		protected $_question_type = 'fill_in_blank';

		/**
		 * @var string
		 */
		static $_shortcode_pattern = '!\[fib(.*)fill=["|\'](.*)["|\']!iSU';

		/**
		 * Do not support answer options
		 *
		 * @var bool
		 */
		protected $_answer_options = false;

		/**
		 * @var array
		 */
		protected $_answer = false;

		/**
		 * @var bool
		 */
		public $_extra_settings = array();

		/**
		 * LP_Question_Fill_In_Blank constructor.
		 *
		 * @param null $the_question
		 * @param null $args
		 *
		 * @throws Exception
		 */
		public function __construct( $the_question = null, $args = null ) {

			parent::__construct( $the_question, $args );


			/* load settings */
			if ( $answers = $this->get_answers() ) {
				foreach ( $answers as $answer ) {
					$settings = $answer->get_meta( '_extra_settings' );

					/*
					error_log('loading answer ');
					error_log(print_r($answer,true));
					error_log('print settings');
					error_log(print_r($settings,true));
					*/

					if ( $settings ) {
						$this->_extra_settings = array();
						foreach ( $settings as  $key => $value ) {
							$this->_extra_settings[ $key ] = $value;
						}
					}
					break;
				}
			}

			//error_log(print_r($this,true));

		}

		/**
		 * Get passage.
		 *
		 * @param bool $checked
		 *
		 * @return mixed|null|string|string[]
		 */
		public function get_passage( $checked = false ) {
			$passage = $this->_passage;

			return $passage;
		}

		/**
		 * Prints the question in frontend user.
		 *
		 * @param bool $args
		 */
		public function render( $args = false ) {
			learn_press_fib_get_template( 'answer.php', array( 'question' => $this ) );
		}

		/**
		 * Get input name.
		 *
		 * @param $fill
		 *
		 * @return string
		 */
		public function get_input_name( $fill ) {
			return '_' . md5( wp_create_nonce( $fill ) );
		}


		/**
		 * Check user answer.
		 *
		 * @param null $user_answer
		 *
		 * @return mixed
		 */
		public function check( $user_answer = null ) {
			$return['correct'] = true;
			$return['mark'] = $this->get_mark();
			$return['success'] = true;
			return $return;
		}

		/**
		 * required for quiz reviews
		 */
		public function get_value() {
			return '';
		}


	}
}
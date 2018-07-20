<?php
/**
 * Template for displaying answer of fill-in-blank question.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/fill-in-blank/content-question/answer.php.
 *
 * @author   ThimPress
 * @package  LearnPress/Fill-In-Blank/Templates
 * @version  3.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

isset( $question ) or die( __( 'Invalid question!', 'learnpress-fill-in-blank' ) );

$quiz = LP_Global::course_item_quiz();

if ( ! $answers = $question->get_answers() ) {
	return;
}

$question->setup_data( $quiz->get_id() );

//error_log(print_r($quiz,true));
foreach ( $answers as $k => $answer ) {
	//error_log(print_r($answer,true));
	$json =  $answer->get_title('display');
	$answer_settings = json_decode($json , true);
	break;
}

//error_log(print_r($answer_settings,true));
//exit;
$user = LP_Global::user();
$quiz = LP_Global::course_item_quiz();
$answer = $question->get_answered();
$answer = str_replace('__SKIPPED__' , '' , $answer);

//exit;

?>
<div class="question-type-fill_in_blank">
    <div class="question-options-<?php echo $question->get_id(); ?> question-passage">

		<?php if ( $user->has_completed_quiz( $quiz->get_id() ) || $user->has_checked_question($question->get_id(), $quiz->get_id()) ) {  ?>

			<span class="blank-fill<?php echo (!empty($class)?' '.join(' ', $class):'')?>"><?php echo esc_html( $question->get_value() ); ?></span>

		<?php } else { ?>

			<input type="text" name="learn-press-question-<?php echo $question->get_id(); ?>"
				value="<?php echo esc_attr( $answer ); ?>"
				class="answer-options fill-in-blank <?php echo (!empty($class)?' '.join(' ', $class):'')?>"/>

		<?php } ?>

		<?php if ( 'yes' === $question->show_correct_answers() ) { ?>
			<span class="blank-status">(<?php echo __('This question accepts any answer'); ?>)</span>
		<?php } ?>
    </div>
</div>
<script>
	;(function ($) {
		"use strict";

		function _ready() {
			jQuery('.lp-form button[type="submit"]').click(function(e) {

				if (jQuery(this).text()=='Prev') {
					return true;
				}

				jQuery('.fill-in-blank').removeClass('shake');

				if (!jQuery('.fill-in-blank').val()) {
					e.preventDefault();
					jQuery('.fill-in-blank').attr({
						'placeholder' : '<?php echo str_replace("'" , "\\'" , $answer_settings['placeholder']); ?>'
					})
					jQuery('.fill-in-blank').addClass('shake');
				}
			})
		}

		$(document).ready(_ready);
	})(jQuery);
</script>

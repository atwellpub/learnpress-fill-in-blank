<?php
/**
 * Admin quiz editor: fib question answer template.
 *
 * @since 3.0.0
 */

?>

<script type="text/x-template" id="tmpl-lp-quiz-fib-question-answer">
    <div class="admin-quiz-fib-question-editor">
        <ul class="fib-settings" style="text-align:left">
            <li class="fib-option">
                <label>
                    <b>
                    <?php _e( 'Error Message:', 'learnpress-fill-in-blank' ); ?>
                    </b>
                </label><br>
                    <input type="text" id="placeholder" v-model="extra_settings.placeholder" @blur="updateAnswer" class="fib-input">

                <p class="description"><?php _e( 'Message to user when no answer is entered.', 'learnpress-fill-in-blank' ); ?></p>
            </li>
        </ul>
    </div>
</script>

<script type="text/javascript">

    function isJSON(str) {
        try {
            return (JSON.parse(str) && !!str);
        } catch (e) {
            return false;
        }
    }

    (function (Vue, $store, $) {
        var init = function() {

            console.log('init');
            console.log(this.question);

        }
        Vue.component('lp-quiz-fib-question-answer', {
            template: '#tmpl-lp-quiz-fib-question-answer',
            props: ['question'],
            data: function () {
                return {extra_settings: []}
            },
            computed: {
                answer: function () {
                    return {
                        answer_order: 1,
                        is_true: '',
                        question_answer_id: String(this.question.answers[0].question_answer_id),
                        text: this.question.answers[0].text,
                        value: ''
                    };
                }
            },
            methods: {
                updateAnswer: function () {
                    var answer = JSON.parse(JSON.stringify(this.answer));
                    var options = this.getOptions();
                    answer.text = JSON.stringify(options);
                    answer.extra_settings = options;

                    $store.dispatch('lqs/updateQuestionAnswerTitle', {
                        question_id: this.question.id,
                        answer: answer
                    });
                },
                getOptions: function() {
                    var extra_settings = {}
                    var search = '[data-item-id="'+this.question.id+'"]';
                    jQuery( search + ' .fib-option .fib-input').each(function() {
                        var id = jQuery(this).attr('id');
                        var value = jQuery(this).val();
                        extra_settings[id] = value;
                    });

                    console.log('extra_settings');
                    console.log(extra_settings);

                    return extra_settings;
                },
                defaultOptions: function() {

                    /* load extra_settings if exists */
                    var json = this.question.answers[0].text;
                    if (isJSON(json)) {
                        var extra_settings = JSON.parse(json);
                        this.extra_settings = extra_settings;
                    } else {
                        this.extra_settings = {};
                        this.extra_settings.placeholder = "This field is required..."
                    }

                },
            },
            created: function () {
                init.apply(this);
                this.defaultOptions();
                /* update on load in case this is the very first load */
                setTimeout(function( e ) {
                    e.updateAnswer();
                } , 1000, this )
            }

        })
    })(Vue, LP_Quiz_Store, jQuery);

</script>

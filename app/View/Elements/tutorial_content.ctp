<form class="items" name="email_and_print" id="email_and_print">
    <?php
    if (!empty($steps)) {
        foreach ($steps as $index => $step) {
            echo "<div class='step' id='step-$index'>";
            if (!empty($step['chapter'])) {
                if (!empty($step['chapter'])) {
                    echo "<h2>" . $step['chapter'] . "</h2>";
                    if ($step['total_steps_in_chapter'] > 1 && $tutorial['Tutorial']['show_chapter_progress']) {
                        echo "<span class='step-number'>" . $step['step_num_within_chapter'] . ' of ' . $step['total_steps_in_chapter'] . "</span>";
                    }
                }
            }
            echo $step['content'];
    ?>
    <div id="navigation" class="clearfix">
      <div id="prev-navigation">
        <a href="#" class="prev browse left ir" title="Previous">Previous</a>
      </div>
      <div id="next-navigation">
        <a href="#" class="next browse right ir" title="Next">Next</a>
    </div>
  <!--    Section X of Y -->
    </div>
    <?php
            echo "</div>";
        }
    }
    ?>
    <?php
    if (!empty($quiz_steps)) {
        foreach ($quiz_steps as $key => $step) {
            $index = $key + count($steps);
            echo "<div class='step no-feedback' id='step-$index'>";
            echo "<h2>";
            echo "Quiz";
            if (!empty($step['chapter']) || !empty($step['step'])) {

                if (!empty($step['chapter'])) {
                    echo ": " . $step['chapter'] . ': ';
                }
                if (!empty($step['step'])) {
                    echo  ': ' . $step['step'];
                }

            }
            echo "</h2>";
            echo $step['content'];
?>
    <div id="navigation" class="clearfix">
      <div id="prev-navigation">
        <a href="#" class="prev browse left ir" title="Previous">Previous</a>
      </div>
      <div id="next-navigation">
        <a href="#" class="next browse right ir" title="Next">Next</a>
    </div>
  <!--    Section X of Y -->
    </div>
<?php
            echo "</div>";
        }
    } ?>
    <div class="step">
        <?php
        if ($tutorial['Tutorial']['certificate'] || $tutorial['FinalQuiz']['certificate']) {
            echo "<h2>Certificate</h2>";
        }

        if (($tutorial['Tutorial']['certificate'] || $tutorial['FinalQuiz']['certificate'])
            && $tutorial['Tutorial']['certificate_email_self']) {
            echo "<p>Please enter your name and email address to retrieve a copy of your completed quiz.</p>";
        }

        if ($tutorial['Tutorial']['certificate'] || $tutorial['FinalQuiz']['certificate']) {
            echo $this->Form->input('certificate_name', array('label' => 'Your name:',
                'placeholder' => 'Your name', 'class' => 'certificate_name'));
        }

        if (($tutorial['Tutorial']['certificate'] || $tutorial['FinalQuiz']['certificate'])
            && $tutorial['Tutorial']['certificate_email_self']) {
            echo $this->Form->input('certificate_email', array('label' => 'Email address(es):',
                'placeholder' => 'Email addresses', 'class' => 'certificate_email'));
            echo "<p class='field-description'>You can enter multiple email addresses separated by commas. If you are doing this for a class, you may need to enter your instructor's email address also.</p>";
        }

        if ($tutorial['Tutorial']['certificate'] || $tutorial['FinalQuiz']['certificate']) {
            echo "<input value='{$tutorial['Tutorial']['id']}' name='tutorial_id' type='hidden' />";
            echo "<input value='{$tutorial['FinalQuiz']['id']}' name='quiz_id' type='hidden' />";
            echo "<input value='Print / Send email' type='submit' name='submit' />";
        }

        $feedback_enabled = Configure::read('user_config.feedback_link.enabled');
        if($tutorial['Tutorial']['show_feedback_link'] && $feedback_enabled){
            $feedback_text = $tutorial['Tutorial']['custom_feedback_link_text'];
            if(empty($feedback_text))
                $feedback_text = Configure::read('user_config.feedback_link.default_text');
            echo "<p><h2>Feedback</h2>";
            echo $this->Html->link($feedback_text, array('action' => 'provide_feedback',
            $tutorial['Tutorial']['id']), array('id' => 'provide-feedback'));
            echo "</p>";
        }
        ?>
        <div id="navigation" class="clearfix">
          <div id="prev-navigation">
            <a href="#" class="prev browse left ir" title="Previous">Previous</a>
          </div>
        </div>
    </div>
</form>
<?php
	if ($tutorial['Tutorial']['popup']) {
		echo $this->Html->script('tutorials/popup_image');
	} else {
		echo $this->Html->script('tutorials/modal_image');
	}
?>

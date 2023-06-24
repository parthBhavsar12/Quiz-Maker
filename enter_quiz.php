<?php
echo '
    <div id="attend-quiz" class="attend-quiz">
    <div class="attendquiz-popup">
        <h2>Attend Quiz</h2>
        <button class="close-quiz">X</button>
        <h4>Enter Quiz code</h4>
        <form action="attend_quiz.php" method="post" name="enter_quiz">
            <input type="text" max-length="35" class="quizcode" placeholder="Enter Quiz Code" title="Enter Quiz Code which you want to Attend" name="quiz_code" required/>
            <button type="submit" name="next" class="submit-quiz" title="Click here to attend Quiz">Next</button>
        </form>
    </div>
    </div>
    <script src="./js/attendquizjs.js"></script>
';
?>
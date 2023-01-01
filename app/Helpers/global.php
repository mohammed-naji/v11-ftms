<?php

use App\Models\Question;

function getQuestionName($id) {
    $q = Question::select('question')->find($id);
    return $q->question;
}

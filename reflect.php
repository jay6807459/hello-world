<?php
$subject = new ReflectionClass(SplSubject);
$subject_method = $subject->getMethods();
$observer = new ReflectionClass(SplObserver);
$observer_method = $observer->getMethods();
var_dump($subject_method, $observer_method);die;

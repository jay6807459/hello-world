<?php
//$subject = new ReflectionClass(SplSubject);
//$methods = $subject->getMethods();
//$property = $subject->getProperties();
//var_dump($methods,$property);die;

/*
 * 具体被观察者
 */
class wolf implements \SplSubject{
    
    protected $name;
    
    protected $message = '狼来了!';
    
    //观察者们
    protected $observers = array();
    
    public function __construct($name) {
        $this->name = $name;
    }
    //附加观察者
    public function attach(\SplObserver $observer){
        echo '添加了观察者' . $observer->getName() . '<br>';
        $this->observers[] = $observer;
    }
    //解除观察者
    public function detach(\SplObserver $observer){
        echo '删除了观察者' . $observer->getName() . '<br>';
        foreach($this->observers as $k => $v){
            if($v->getName() == $observer->getName()){
                unset($this->observers[$k]);
            }
        }
    }
    //通知观察者
    public function notify(){
        echo $this->name . '说:' . $this->getMessage() . '<br>';
        foreach($this->observers as $observer){
            $observer->update($this);
        }
    }
    
    public function getMessage(){
        return $this->message;
    }
}

/**
 * 抽象观察者
 */
abstract class Sheep implements \SplObserver{
    
    protected $name;
    
    public function getName(){
        return $this->name;
    }
    //更新
    public function update(\SplSubject $subject) {
        echo $this->name . '收到通知:' . $subject->getMessage() . '<br>';
    }
}

/**
 * 具体观察者
 */
class PleasantSheep extends Sheep{
    
    protected $name = '喜羊羊';
    
}

class LazySheep extends Sheep{
    
    protected $name = '懒羊羊';
    
}

class BeautifulSheep extends Sheep{
    
    protected $name = '美羊羊';
    
}

$wolf = new wolf('灰太狼');
$test = new PleasantSheep();
$wolf->attach(new PleasantSheep());
$wolf->attach(new LazySheep());
$wolf->attach(new BeautifulSheep());
$wolf->detach(new LazySheep());
$wolf->notify();

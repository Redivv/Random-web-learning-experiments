<?php

abstract class AchivementType
{
    public function name(): string
    {
        $class = (new ReflectionClass($this))->getShortName();

        return trim(preg_replace('/[A-Z]/', ' $0', $class));
    }

    public function icon(): string
    {
        return strtolower(str_replace(' ', '-', $this->name())) . '.png';
    }

    abstract public function qualifier($user);
}

class BestAnswer extends AchivementType
{
    public function qualifier()
    {
        # code...
    }
}


$achivement = new BestAnswer();

var_dump($achivement->name());

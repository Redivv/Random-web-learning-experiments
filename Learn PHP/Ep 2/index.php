<?php

class Team{

    protected $name;
    protected $members;

    public function __construct(string $name,array $members){
        $this->name = $name;
        $this->members = $members;
    }

    public function name() : string{
        return $this->name;
    }

    public static function start(... $params) : Team{
        return new static(... $params);
    }
}

class Member{
    protected $name;

    public function __construct(string $name){
        $this->name = $name;
    }
}

$kek = Team::start("penisy",[
    new Member('kek'), new Member('pen')
]);

var_dump($kek->name());




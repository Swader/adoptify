<?php

return function () {
    return new class
    {
        protected $adjectives = [
            'purple',
            'feral',
            'bloated',
            'cute',
            'cuddly',
            'confused',
            'dirty',
            'shackled',
            'dormant',
            'sleepy',
            'sneaky',
            'quiet',
            'spiky',
            'poisonous',
            'golden',
            'big',
        ];
        protected $animals = [
            'mammoth',
            'beagle',
            'kitten',
            'gator',
            'spider',
            'wildcat',
            'boar',
            'elephant',
            'cricket',
            'wood tick',
            'owl',
        ];

        public function generate()
        {
            return ucwords($this->adjectives[mt_rand(
                0, count($this->adjectives) - 1
            )] . ' ' . $this->animals[mt_rand(
                0, count($this->animals) - 1
            )]);
        }
    };
};
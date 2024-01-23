<?php

namespace rmvc\vc\Interfaces;

interface Gate
{
    public function check($argument): bool;
}
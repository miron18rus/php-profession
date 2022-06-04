<?php

namespace app\interfaces;

interface iRenderer
{
    public function renderTemplate($template, $params = []);
}
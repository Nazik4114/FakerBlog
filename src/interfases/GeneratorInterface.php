<?php

namespace Nazik\FakerBlog\interfases;

interface GeneratorInterface{

    public function generator();
    public function save($author,$id);
    public function setDriver($dbh);
}
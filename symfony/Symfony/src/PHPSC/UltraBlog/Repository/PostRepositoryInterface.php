<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PHPSC\UltraBlog\Repository;

interface PostRepositoryInterface {

    public function find($id);
    
    public function findLatestThree();
}

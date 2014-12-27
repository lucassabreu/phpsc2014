<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PHPSC\UltraBlog\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of PostType
 *
 * @author Lucas dos Santos Abreu <lucas.abreu@gmail.com>
 */
class PostType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', 'text', ['label' => 'post.form.title']);
        $builder->add('content', 'textarea', ['label' => 'post.form.content']);
        $builder->add('createdAt', 'date', ['label' => 'post.form.createdAt']);
        $builder->add('Save', 'submit', ['label' => 'post.form.submit']);
    }

    public function getName() {
        return "post";
    }

}

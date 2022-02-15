<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    // on souhaite définir ce qui peut être modifiable sur notre entity
    protected $_accessible = [ 
        '*' => true, // * : tout peut être modifiable
        'id' => false, // : id jamais modifiable
        'slug' => false, // l'url via titre non modifiable
    ];
}
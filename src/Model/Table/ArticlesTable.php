<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Event\EventInterface;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp'); // 'Timestamp' definit automatiquement la date de création lors d'une créa d'un article
    }

    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) //si $entity est nouveau et qu'il n'y a pas de slug, alors:
        {
            $sluggedTitle = Text::slug($entity->title); // permet de générer un url en lien avec le titre en incluant des tirets entre les espaces
            $entity->slug = substr($sluggedTitle, 0, 191); // on affecte au slug une restriction sur la taille
        }
    }

    public function validationDefault(Validator $validator): Validator
    {
        // function pour définir des règles de sécurité et ne pas valider n'importe quoi
        $validator
            ->notEmptyString('title', 'This field cannot be empty')
            ->minLength('title', 10, 'Minimum 10 characters')
            ->maxLength('title', 255, 'Maximum 255 characters')

            ->notEmptyString('body', 'This field cannot be empty')
            ->minLength('body', 10, 'Minimum 10 characters')
        ;

        return $validator;
    }
}
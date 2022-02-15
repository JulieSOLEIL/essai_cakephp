<?php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator'); //pour permettre la pagination, il faut au préalable loader le component

        $articles = $this->Paginator->paginate($this->Articles->find()); //permet pagination des articles

        $this->set(compact('articles')); //permet de setter la var articles
    }

    public function view($slug = null)
    {
        // j'initialise la vue de chaque article avec slug et si ça échoue, il y aura un msg d'erreur qui s'affichera avec 'firstOfFail'
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function add()
    {
        // création new article avec méthode newEmptyEntity
        $article = $this->Articles->newEmptyEntity();

        if ($this->request->is('post')) // si le form est en méthode POST, alors :
        {
            $article = $this->Articles->patchEntity($article, $this->request->getData()); //patche moi la variable et récupère les datas de cette variable
            $article->user_id = $this->request->getAttribute('identity')->getIdentifier(); //fixe les datas du user_id dans une méthode 'identity'

            if ($this->Articles->save($article)) // et si l'article est bien sauvegarder,
            {
                $this->Flash->success('Your article has been saved.'); //déclare à l'user le succès de sa sauvegarde
                return $this->redirect(['action' => 'index']); // et redirige l'user à l'index.
            }
            $this->Flash->error('Unable to add your article.'); // et si l'article n'est pas sauvegarder, affiche le msg d'erreur.
        }
          //on set la variable
        $this->set(compact('article'));
    }

    public function edit($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();

        if ($this->request->is(['post', 'put'])) //si le form est en méthode post ou edit,
        {
            $article = $this->Articles->patchEntity($article, $this->request->getData(), [
                'accessibleFields' => ['user_id' => false]
            ]);

            if ($this->Articles->save($article)) 
            {
                $this->Flash->success('Your article has been updated.'); 
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to update your article.');
        }
        //on set la variable
        $this->set(compact('article'));
    }

    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']); // demande la permission de suppr un form en post

        $article = $this->Articles->findBySlug($slug)->firstOrFail();

        if ($this->Articles->delete($article))
        {
            $this->Flash->success( __('The "{0}" article has been successfully deleted', $article->title)); // le double underscore récupère le slug
            return $this->redirect(['action' => 'index']);
        }
    }
}

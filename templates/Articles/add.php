<h1>Add Article</h1>

<?php 

    echo $this->Form->create($article); //création d'un form en lien avec $article, méthode POST par défaut
    echo $this->Form->control('title'); //création d'un input title
    echo $this->Form->control('body', ['rows' => '3']); //création d'un input body avec 3 rows
    echo $this->Form->button('Save Article'); //création d'un button 
    echo $this->Form->end(); // pour fermer le form
?>
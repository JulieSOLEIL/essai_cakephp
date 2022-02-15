<h1><?= h($article->title) ?></h1> <!-- utilise méthode 'h' qui est un htmlSpecialChars pour meilleur sécurisation -->
<p><?= h($article->body) ?></p>
<p><small>Created :<?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>
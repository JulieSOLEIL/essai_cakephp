<h1>Articles</h1>
<?= $this->Html->link('Add Article', ['action' =>'add']) ?> <!-- faire appel à un helper pour créer action ajouter article -->
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <!-- On veut faire appel à un helper pour créer un lien qui dirige vers une méthode "view", puis url de l'article avec un array -->
                <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
            </td>
            <td>
                <!-- on veut déclarer la date formatée de l'article -->
                <?= $article->created->format(DATE_RFC850) ?>
            </td>
            <td>
                <!-- On veut faire appel à un helper pour créer un lien qui dirige vers une view, puis url de l'article avec un array -->
                <?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?>
                <!-- création d'un lien delete -->
                <?= $this->Form->postLink(
                    'Delete', 
                    ['action' => 'delete', $article->slug], 
                    ['confirm' => 'Are you sure you want to delete definitely this article ?'])
                ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>
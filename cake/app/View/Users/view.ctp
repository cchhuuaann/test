<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($user['User']['username']); ?></h1>

<p>Password: <?php echo $post['User']['password']; ?></p>

<p>Rule: <?php echo $post['User']['rule']; ?></p>

<p><small>Created: <?php echo $post['User']['created']; ?></small></p>

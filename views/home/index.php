<div>
    <p>Welcome!</p>
    <p><strong>You currently have <?php echo count($viewmodel); ?> books.</strong></p>
    <?php if(!count($viewmodel) == 0) : ?>
    <?php foreach($viewmodel as $item): ?>
    <div style="border: 2px solid lightgrey; margin_bottom: 3px; padding:12px;">
    <h3>Title: <?php echo htmlspecialchars($item['title']); ?></h3>
    <p>Year: <?php echo htmlspecialchars($item['year']); ?></p>
    <p>Author: <?php echo htmlspecialchars($item['author']); ?></p>
    <p>ISBN: <?php echo htmlspecialchars($item['isbn']); ?></p>
    <?php $isbn = $item['isbn']; ?>
    <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="hidden" name="delete" value="yes">
        <input type="hidden" name="isbn" value="<?php echo $isbn; ?>">
        <input type="submit" value="DELETE BOOK!">
    </form>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

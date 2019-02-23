<div>
    <h3>Edit a book!</h3>
    <p><strong>Modify any book details and click update.</strong></p>
    <?php if(count($viewmodel) == 0) : ?>
       <p>You don't have any books in your book database yet. Click 'Add a book' in the menu above to get started.</p>
    <?php endif; ?>
    <?php if(!count($viewmodel) == 0) : ?>
    <?php foreach($viewmodel as $item): ?>
    <div style="border: 2px solid lightgrey; margin_bottom: 3px; padding:12px;">
    
    <?php $isbn = htmlspecialchars($item['isbn']); ?>
    <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($item['title']); ?>"><br>
        <label>Author:</label><br>
        <input type="text" name="author" value="<?php echo htmlspecialchars($item['author']); ?>"><br>
        <label>Year:</label><br>
        <input type="text" name="year" value="<?php echo htmlspecialchars($item['year']); ?>"><br>
        <label>ISBN:</label><br>
        <input type="text" name="isbn" value="<?php echo htmlspecialchars($item['isbn']); ?>"><br>


        <input type="hidden" name="current_isbn" value="<?php echo $isbn; ?>">
        <input type="submit" value="UPDATE BOOK!">
    </form>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

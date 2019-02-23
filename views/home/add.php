<div>
    <h3>Add a book!</h3>
    <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label>Title:</label><br>
        <input type="text" name="title" placeholder="title"><br>
        <label">Author:</label><br>
        <input type="text" name="author" placeholder="author"><br>
        <label">Year:</label><br>
        <input type="text" name="year" placeholder="year"><br>
        <label">ISBN:</label><br>
        <input type="text" name="isbn" placeholder="isbn"><br><br>
        <input type="submit" value="ADD BOOK!">
    </form>
    <p><?php echo $viewmodel; ?></p>
</div>

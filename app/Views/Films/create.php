<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="/films/store" method="POST" >
        <label>Name <input type="text" name='Name'></input></label>
        <label>Release Year <input type="text" name='ReleaseYear'></input></label>
        <label>Duration <input type="text" name='DurationMinutes'></input></label>
        <label>Genre
            <select name='GenreId'>
                <?php foreach ($genres as $genre) : ?>
                    <option value="<?= esc($genre['GenreId']) ?>">
                        <?= esc($genre['GenreName']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </label>


        <input type="submit">
    </form>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>

    <form action="/films/update/<?= esc($film['FilmId']) ?>" method="POST" >
        <label>Name
            <input type="text" name='Name' value='<?= esc($film['Name'])?>'></input>
        </label>
        <label>Release Year
            <input type="text" name='ReleaseYear' value='<?= esc($film['ReleaseYear'])?>'></input>
        </label>
        <label>Duration
            <input type="text" name='DurationMinutes' value='<?= esc($film['DurationMinutes'])?>'></input>
        </label>
        <label>Genre
            <select name='GenreId'>
                <?php foreach ($genres as $genre) : ?>
                    <option value="<?= esc($genre['GenreId']) ?>"
                        
                        <?= ($genre['GenreId'] == $film['GenreId']) ? 'selected' : '' ?>>
                        <?= esc($genre['GenreName']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </label>

        <input type="submit">
    </form>

</body>

</html>
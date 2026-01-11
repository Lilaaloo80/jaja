<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    echo password_hash('admin', PASSWORD_DEFAULT);


    ?>
    <table border="1" cellpadding="5" cellspacing="0" >
        <thead>
            <th>Name</th>
            <th>Year</th>
            <th>Duration</th>
            <th>Genre</th>
            <th>Edit</th>
            <th>Delete</th>

        </thead>
        <tbody>
            <?php foreach ($films as $film) : ?>
                <tr>
                    <td>
                        <?= esc($film['Name'])?>
                    </td>
                    <td>
                        <?= esc($film['ReleaseYear'])?>
                    </td>
                    <td>
                        <?= esc($film['DurationMinutes'])?>
                    </td>
                    <td>
                        <?= esc($film['GenreName']) ?>
                    </td>
                    <td>
                        <a href="/films/edit/<?= esc($film['FilmId']) ?>">Edit</a>
                    </td>
                    <td>
                        <form action="/films/delete/<?= esc($film['FilmId']) ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
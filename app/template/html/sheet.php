<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sheet</title>
    </head>
    <body>
        <table>
            <?php foreach(@$rows as $row): ?>
                <tr>
                    <?php foreach($row as $value): ?>
                        <td><?php  echo $value; ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
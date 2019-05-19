<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student List</title>
</head>
<body>
    <table>
        <thead>
            <th>Student ID</th>
            <th>Given Name</th>
            <th>Family Name</th>
            <th>Full Name</th>
        </thead>
        <tbody>
            <?php foreach ($results as $student) : ?>
            <tr>
                <td>0</td>
                <td><?= $student->givenName ?></td>
                <td><?= $student->familyName ?></td>
                <td><?= $student->getFullName() ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
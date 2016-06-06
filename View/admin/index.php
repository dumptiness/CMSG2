<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des pages</title>
    <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../../bootstrap/css/" rel="stylesheet">
    <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>
<body role="document">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/admin">Back Office</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="../">Retour au site</a></li>
                <li class="active"><a href="">Pages</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container theme-showcase" role="main">
    <h1>Liste des pages</h1>
    <a href="?a=ajouter">+ Ajouter</a><br><br>
    <table class="table-bordered table-responsive table">
        <tr>
            <th>id</th>
            <th>slug</th>
            <th>Title</th>
            <th>h1</th>
            <th>Actions</th>
        </tr>
        <?php foreach($data as $page) : ?>
        <tr>
            <td><?=$page->id?></td>
            <td><?=$page->slug?></td>
            <td><?=$page->title?></td>
            <td><?=$page->h1?></td>
            <td>
                <a href="/admin/index.php?a=details&id=<?=$page->id?>" class="btn btn-primary">Détails</a>
                <a href="/admin/index.php?a=modifier&id=<?=$page->id?>" class="btn btn-success">Modifier</a>
                <a href="/admin/index.php?a=supprimer&id=<?=$page->id?>" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="?a=ajouter">+ Ajouter</a>
</div>
</body>
</html>
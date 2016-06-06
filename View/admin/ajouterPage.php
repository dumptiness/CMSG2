<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une page</title>
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
            </ul>
        </div>
    </div>
</nav>
<div class="container theme-showcase" role="main">
    <h1>Ajouter une page</h1>
    <form action="/admin/index.php?a=ajouter" method="post" style="width: 400px;">
        <fieldset class="form-group">
            <label for="formGroupExampleInput">slug</label>
            <input type="text" class="form-control" name="page_slug" placeholder="slug">
        </fieldset>
        <fieldset class="form-group">
            <label for="formGroupExampleInput">Title</label>
            <input type="text" class="form-control" name="page_title" placeholder="title tab">
        </fieldset>
        <fieldset class="form-group">
            <label for="formGroupExampleInput">h1</label>
            <input type="text" class="form-control" name="page_h1" placeholder="h1">
        </fieldset>
        <fieldset class="form-group">
            <label for="exampleTextarea">body</label>
            <textarea class="form-control" name="page_body" rows="3" placeholder="paragraphe"></textarea>
        </fieldset>
        <fieldset class="form-group">
            <label for="formGroupExampleInput">span_text</label>
            <input type="text" class="form-control" name="span_text" placeholder="texte du span">
        </fieldset>
        <fieldset class="form-group">
            <label for="formGroupExampleInput">span_class</label>
            <input type="text" class="form-control" name="span_class"
                   placeholder="label-danger ou label-success">
        </fieldset>
        <fieldset class="form-group">
            <label for="formGroupExampleInput">img</label>
            <input type="text" class="form-control" name="page_img" placeholder="img/img.png">
        </fieldset>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <br><br>
</div>
</body>
</html>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">IDK</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php
                foreach($nav as $page) :
                    $active = "";
                    if($slug == $page->slug){
                        $active = "class=\"active\"";
                    }
                ?>
                    <li class="<?= isActive($page->slug, $slug)?>"><a href="index.php?p=<?=$page->slug?>"><?=$page->title?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
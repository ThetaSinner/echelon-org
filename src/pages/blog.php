<!DOCTYPE html>
<html>
<head>
    <? require_once $_SERVER['DOCUMENT_ROOT'] . '/fragments/header-fragment.php' ?>

    <script type="text/javascript">
        activateNavItemWhenReady('el-nav-blog');
    </script>
</head>
<body>
    <? require_once $_SERVER['DOCUMENT_ROOT'] . '/fragments/nav-header.php' ?>
    <div class="container">
        <div class="bg-light el-content-container">
            <? require_once $_SERVER['DOCUMENT_ROOT'] . '/fragments/post-nav.php' ?>
        </div>
    </div>
</body>
</html>

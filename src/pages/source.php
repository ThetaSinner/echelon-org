<!DOCTYPE html>
<html>
<head>
    <? require_once $_SERVER['DOCUMENT_ROOT'] . '/fragments/header-fragment.php' ?>

    <script type="text/javascript">
        activateNavItemWhenReady('el-nav-source');
    </script>
</head>
<body>
    <? require_once $_SERVER['DOCUMENT_ROOT'] . '/fragments/nav-header.php' ?>

    <div class="container">
        <div class="bg-light el-content-container">
            <div class="border-bottom border-left border-primary mt-3 p-2 mx-3">
                <p>
                    The compiler. This is a work in progress and was initially intended as a learning project to understand compiler technology.
                    I see it developing into the sandpit for ideas from this site.
                </p>
                <a href="https://github.com/ThetaSinner/echelon">Echelon</a>
            </div>
            <div class="border-bottom border-left border-primary mt-3 p-2 mx-3">
                <p>
                    A helper library for working with Unicode input.
                </p>
                <a href="https://github.com/ThetaSinner/echelon-unicode">echelon-unicode</a>
            </div>
            <div class="border-bottom border-left border-primary mt-3 p-2 mx-3">
                <p>
                    A hand-crafted parser which accepts Unicode input.
                </p>
                <a href="https://github.com/ThetaSinner/echelon-unicode-parser">echelon-unicode-parser</a>
            </div>
        </div>
    </div>

    <? require_once $_SERVER['DOCUMENT_ROOT'] . '/fragments/footer.php' ?>
</body>
</html>

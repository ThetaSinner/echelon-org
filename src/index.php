<!DOCTYPE html>
<html>
<head>
    <? require_once './fragments/header-fragment.php' ?>

    <script type="text/javascript">
        activateNavItemWhenReady('el-nav-home');
    </script>
</head>
<body>
    <? require_once './fragments/nav-header.php' ?>

    <div class="container">
        <div class="bg-dark el-content-container">
            <p>This is the home of the Echelon project.</p>
            <p>
                The primary aim of the project is to define a programming language. But there are lots of those, and setting out to re-invent the wheel would probably be unrealistic.
                Instead, the idea is to analyse and research software development technology. 
                One goal is to set out a manifesto for the next generation of software development. Until then, here are some of the focus points:
            </p>
            <ul>
                <li>How can software agility be improved? Continue making changes quickly as software grows.</li>
                <li>Is it possible to break the compiler software down, to allow easier development of third party tools? For example, static analysis.</li>
                <li>Software at scale, what can be done to maintain intention and integrity in very large codebases.</li>
                <li>Programming the compiler. Are there more opportunities for language support for programming the compiler in a general purpose language</li>
                <li>And many more?</li>
            </ul>
            <hr />
            <p>It's just me for the moment, and most of my focus is on another project. So for now I'm just planning to add blog posts.</p>
        </div>
    </div>
</body>
</html>

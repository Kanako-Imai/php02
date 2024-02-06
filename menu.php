<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index01.php">ブックマーク登録</a>　
            <a class="navbar-brand" href="select01.php">ブックマーク表示</a>　
            <!-- <a class="navbar-brand" href="user.php">ユーザー登録</a>　
            <a class="navbar-brand" href="user_select.php">ユーザー表示</a>　 -->
            <a class="navbar-brand" href="logout.php">ログアウト</a>
            <?php
                $kanri_flg = getUserFlag();
                if ($kanri_flg == 1) {
                    // ユーザー管理フラグが1の場合（管理者）
                    echo '<a class="navbar-brand" href="user.php">ユーザー登録</a>';
                    echo '<a class="navbar-brand" href="user_select.php">ユーザー表示</a>';
                }
            ?>
        </div>
    </div>
</nav>


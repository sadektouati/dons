<footer>
    <?php if($url != '/login'){ ?>
        <nav>
        <?php 
        if(empty($_SESSION['social_id'])){ ?>
            <a href="/login">سجل كمتبرع</a>
        <?php }else{
            if($url == '/profile'){ ?>
                <a href="?edit=true">تعديل</a>
            <?php }else{ ?>
                <a href="/profile">حسابي</a>
            <?php } ?>
            <a href="/">بحث عن متبرع</a>
        <?php } ?>
        </nav>
    <?php } ?>
</footer>
</body>
</html>
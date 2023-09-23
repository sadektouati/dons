<?php

$number = isGetedNullable('number') ?? 1;

if(isGetedNullable('blood_type') || isGetedNullable('ville_id') || isGetedNullable('wilaya_id')){
    $profileQuery = pg_query_params($conn, "select * from app.find_doner($1, $2, $3, $4, $5)", [$_SESSION['social_id'], isGetedNullable('blood_type'), isGetedNullable('ville_id'), isGetedNullable('wilaya_id'), $number]);
    $profile = pg_fetch_assoc($profileQuery);
}

$wilayasQuery = pg_query_params($conn, "select * from app.wilayas_list()", []);
$wilayas = pg_fetch_all($wilayasQuery);

if(isGetedNullable('wilaya_id')){
    $villesQuery = pg_query_params($conn, "select * from app.villes_list($1)", [isGetedNullable('wilaya_id')]);
    $villes = pg_fetch_all($villesQuery);
}

$bloodTypesQuery = pg_query_params($conn, "select * from app.blood_types_list()", []);
$bloodTypes = pg_fetch_all($bloodTypesQuery);
?>
<form>

    <select name="blood_type">
        <option value="" disabled selected>فصيلة الدم</option>
        <?php foreach ($bloodTypes as $bloodType){ ?>
            <option value="<?= $bloodType['name']?>" <?= isSelected(isGetedNullable('blood_type'), $bloodType['name']) ?>><?= $bloodType['name']?></option>
        <?php } ?>
    </select>

    <select name="wilaya_id">
        <option value="" disabled selected>ولاية</option>
        <?php foreach ($wilayas as $wilaya){ ?>
            <option value="<?= $wilaya['wilaya_id']?>" <?= isSelected(isGetedNullable('wilaya_id'), $wilaya['wilaya_id']) ?>><?= $wilaya['wilaya_id']?> - <?= $wilaya['name']?></option>
        <?php } ?>
    </select>

    <?php if(isGetedNullable('wilaya_id')){ ?>
        <select name="ville_id">
            <option value="" disabled selected>مدينة</option>
            <?php foreach ($villes as $ville){ ?>
                <option value="<?= $ville['ville_id']?>" <?= isSelected(isGetedNullable('ville_id'), $ville['ville_id']) ?>><?= $ville['name']?></option>
            <?php } ?>
        </select>
    <?php } ?>

</form>
<main>
    <?php
        if(isGetedNullable('blood_type') == null && isGetedNullable('ville_id') == null && isGetedNullable('wilaya_id') == null ){
             ?>
            <header>مرحباً</header>
            <picture>
                <img src="assets/images/hero.jpg">
            </picture>
            <p>هنا تجد متبرعين يمكن أن يساعدوك. يرجى اختيار فصيلة الدم المطلوبة ثم الولاية</p>
            <p>
            ثم يظهر لك رقم هاتف احد المتبرعين. يكفي الضغط على رقم الهاتف للاتصال
            </p>
        <?php
        }elseif(empty($profile)){ ?>
            <header>no results</header>
            <p>suggestions....</p>
            <?php if(isGetedNullable('ville_id')){ ?>
            <p>
            قد تجد متبرعين من خلال البحث في جميع المدن 
                <a href="?blood_type=<?= urlencode(isGetedNullable('blood_type'))?>&wilaya_id=<?= isGetedNullable('wilaya_id')?>">اظهر النتائج</a>
            </p>
            <?php }elseif(isGetedNullable('wilaya_id')){ ?>
                <p>
                يمكنك العثور على المتبرعين من خلال البحث في جميع الولايات
                <a href="?blood_type=<?= urlencode(isGetedNullable('blood_type'))?>">اظهر النتائج</a>
            </p>
            <?php } ?>
    <?php 
        }else{
            // <span><?= $profile["last_donation"] </span>
             ?>
            <header><?= $profile["total"] ?></header>
            <section>
                <header>
                    <span><?= $profile["full_name"] ?></span>
                    <span><?= $profile["address"] ?></span>
                </header>
                <p dir="ltr">
                    <?= $profile["blood_type"] ?>
                </p>
                <a href="tel:<?= $profile["phone"] ?>" dir="ltr">
                    <?= $profile["phone"] ?>
                </a>
            </section>
            <footer>
                <a href="/?blood_type=<?= urlencode(isGetedNullable('blood_type'))?>&ville_id=<?= isGetedNullable('ville_id')?>&wilaya_id=<?=isGetedNullable('wilaya_id')?>&number=<?= $number-1?>" class="<?= $number <= 0 ? 'disabled' : '' ?>">المتبرع السابق <?= $number - 1 ?></a>
                <a><?= $number ?></a>
                <a href="/?blood_type=<?= urlencode(isGetedNullable('blood_type'))?>&ville_id=<?= isGetedNullable('ville_id')?>&wilaya_id=<?=isGetedNullable('wilaya_id')?>&number=<?=$number+1?>" class="<?= ($number >= $profile["total"])  ? 'disabled' : '' ?>">المتبرع التالي <?= $number + 1 ?></a>
            </footer>
    <?php } ?>
</main>
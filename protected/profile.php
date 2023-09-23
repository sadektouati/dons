<?php

$error = [];
$isDisabled = isGetedNullable('edit') ? '' : 'disabled';

if(isGetedNullable('save')){

    if (isGetedNullable('phone') && !preg_match('/^07[0-9]{8}$|^06[0-9]{8}$|^05[0-9]{8}$|^$/', $_GET['phone'])) {
		$error['phone'] = 'should be oreedoo, mobilis, or djezzy';
	}

    if (isGetedNullable('first_name') && !preg_match('/^[-\' \p{L}]+$/u', $_GET['first_name'])) {
		$error['first_name'] = 'should be a first name';
	}

    if (isGetedNullable('last_name') && !preg_match('/^[-\' \p{L}]+$/u', $_GET['last_name'])) {
		$error['show_name'] = 'should be a first name';
	}

    if (isGetedNullable('show_name') && !in_array(isGetedNullable('show_name'), ['f', 't'])) {
		$error['show_name'] = 'select from the list';
	}

    if (isGetedNullable('able_to_donate') && !in_array(isGetedNullable('able_to_donate'), ['f', 't'])) {
		$error['able_to_donate'] = 'select from the list';
	}

    if (isGetedNullable('year_of_birth') && !is_numeric($_GET['year_of_birth'])) {
		$error['year_of_birth'] = 'select from the list';
	}

    if (isGetedNullable('last_donation') && !checkdate(explode('-', $_GET['last_donation'])[1], explode('-', $_GET['last_donation'])[2], explode('-', $_GET['last_donation'])[0])) {
		$error['last_donation'] = 'should be a date';
	}

    if (isGetedNullable('ville_id') && !is_numeric($_GET['ville_id'])) {
		$error['ville_id'] = 'select from the list';
	}

    if(empty($error)){
        $updateProfileQuery = pg_query_params($conn, "select * from app.update_profile($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)", [$_SESSION['social_id'], isGetedNullable('phone'), isGetedNullable('first_name'), isGetedNullable('last_name'), isGetedNullable('show_name'), isGetedNullable('year_of_birth'), isGetedNullable('blood_type'), isGetedNullable('able_to_donate'), isGetedNullable('last_donation'), isGetedNullable('ville_id')]);
        $updateProfileResult = pg_fetch_assoc($updateProfileQuery);
        echo 'updated successfully... <meta http-equiv="refresh" content="2; url=/profile">';
        return;
    }

}


$profileQuery = pg_query_params($conn, "select * from app.profile($1)", [$_SESSION['social_id']]);
$profile = pg_fetch_assoc($profileQuery);

$wilayasQuery = pg_query_params($conn, "select * from app.wilayas_list()", []);
$wilayas = pg_fetch_all($wilayasQuery);

$villesQuery = pg_query_params($conn, "select * from app.villes_list($1)", [$profile['wilaya_id']]);
$villes = pg_fetch_all($villesQuery);

$bloodTypesQuery = pg_query_params($conn, "select * from app.blood_types_list()", []);
$bloodTypes = pg_fetch_all($bloodTypesQuery);
?>


<main>
    <?php
    if (empty($error) != false){ ?>
        <div class="error">
            <span>يرجى تصحيح الأخطاء أدناه</span>
        </div>
    <?php } ?>
    <form>

        <fieldset>
            <span class="<?= empty($error['phone']) ? '' : 'hasError' ?>">
                <label>الهاتف</label>
                <input type="tel" name="phone" value="<?= $profile['phone']?>" <?= $isDisabled ?>>
                <span><?= $error['phone'] ?? ''?></span>
            </span>
        </fieldset>

        <fieldset>
            <span class="<?= empty($error['blood_type']) ? '' : 'hasError' ?>">
                <label>فصيلة الدم</label>
                <select name="blood_type" <?= $isDisabled ?>>
                    <option value="" disabled selected></option>
                    <?php foreach ($bloodTypes as $bloodType){ ?>
                        <option value="<?= $bloodType['name']?>" <?= isSelected($profile['blood_type'], $bloodType['name']) ?>><?= $bloodType['name']?></option>
                    <?php } ?>
                </select>
                <span><?= $error['blood_type'] ?? ''?></span>
            </span>

            <span class="<?= empty($error['last_donation']) ? '' : 'hasError' ?>">
                <label>التبرع الأخير</label>
                <input type="date" name="last_donation" value="<?= $profile['last_donation']?>" <?= $isDisabled ?>>
                <span><?= $error['last_donation'] ?? ''?></span>
            </span>

            <span class="<?= empty($error['able_to_donate']) ? '' : 'hasError' ?>">
                <label>قادر على التبرع</label>
                <select name="able_to_donate" <?= $isDisabled ?>>
                    <option value="" disabled selected></option>
                    <option value="t" <?= isSelected($profile['able_to_donate'], 't') ?>>نعم</option>
                    <option value="f" <?= isSelected($profile['able_to_donate'], 'f') ?>>لا</option>
                </select>
                <span><?= $error['able_to_donate'] ?? ''?></span>
            </span>
        </fieldset>

        <fieldset>

            <span class="<?= empty($error['wilaya_id']) ? '' : 'hasError' ?>">
                <label>ولاية</label>
                <select name="wilaya_id" <?= $isDisabled ?>>
                    <option value="" disabled selected></option>
                    <?php foreach ($wilayas as $wilaya){ ?>
                        <option value="<?= $wilaya['wilaya_id']?>" <?= isSelected($profile['wilaya_id'], $wilaya['wilaya_id']) ?>><?= $wilaya['wilaya_id']?> - <?= $wilaya['name']?></option>
                    <?php } ?>
                </select>
                <span><?= $error['wilaya_id'] ?? ''?></span>
            </span>

            <span class="<?= empty($error['ville_id']) ? '' : 'hasError' ?>">
                <label>مدينة</label>
                <select name="ville_id" <?= $isDisabled ?>>
                    <option value="" disabled selected></option>
                    <?php foreach ($villes as $ville){ ?>
                        <option value="<?= $ville['ville_id']?>" <?= isSelected($profile['ville_id'], $ville['ville_id']) ?>><?= $ville['name']?></option>
                    <?php } ?>
                </select>
                <span><?= $error['ville_id'] ?? ''?></span>
            </span>

        </fieldset>

        <fieldset>

            <span class="<?= empty($error['first_name']) ? '' : 'hasError' ?>">
                <label>الاسم</label>
                <input type="text" name="first_name" value="<?= $profile['first_name']?>" <?= $isDisabled ?>>
                <span><?= $error['first_name'] ?? ''?></span>
            </span>

            <span class="<?= empty($error['blood_type']) ? '' : 'hasError' ?>">
                <label>اللقب</label>
                <input type="text" name="last_name" value="<?= $profile['last_name']?>" <?= $isDisabled ?>>
                <span><?= $error['last_name'] ?? ''?></span>
            </span>

            <span class="<?= empty($error['show_name']) ? '' : 'hasError' ?>">
                <label>اظهر اسمي في البحث</label>
                <select name="show_name" <?= $isDisabled ?>>
                    <option value="" disabled selected></option>
                    <option value="t" <?= isSelected($profile['show_name'], 't') ?>>نعم</option>
                    <option value="f" <?= isSelected($profile['show_name'], 'f') ?>>لا</option>
                </select>
                <span><?= $error['show_name'] ?? ''?></span>
            </span>

            <span class="<?= empty($error['year_of_birth']) ? '' : 'hasError' ?>">
                <label>سنة الميلاد</label>
                <select name="year_of_birth" <?= $isDisabled ?>>
                    <option value="" disabled selected></option>
                    <?php for ($i=date('Y') - 18; $i >=date('Y') - 65; $i--){ ?>
                        <option value="<?= $i?>" <?= isSelected($profile['year_of_birth'], $i) ?>><?= $i?></option>
                    <?php } ?>
                </select>
                <span><?= $error['year_of_birth'] ?? ''?></span>
            </span>

        </fieldset>

        <?php if(isGetedNullable('edit') ){ ?>

            <fieldset class="footer">

                <span class="row">
                    <input type="submit" name="save" value="تسجيل">
                    <a href="/profile">عودة</a>
                </span>

            </fieldset>

        <?php } ?>

    </form>
</main>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Persepsi Anti Korupsi</title>
    <meta name="description" content="Form Persepsi Anti Korupsi" />
    <meta name="keywords" content="balai besar keramik, kementrian perindustrian" />
    <meta name="author" content="ican" />
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/cs-skin-boxes.css" />
    <script src="/assets/js/modernizr.custom.js"></script>
</head>

<body>
    <div class="container">

        <div class="fs-form-wrap" id="fs-form-wrap">
            <div class="fs-title">
                <h1>Form Persepsi Anti Korupsi</h1>
                <div class="codrops-top">
                    <img src="/assets/img/logokemenperin-07.png" style="width:22vh;">
                </div>
            </div>
            <form id="myform" class="fs-form fs-form-full" autocomplete="off" method="post" action="/kuisioner-public-send">
                <ol class="fs-fields">
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q1">Nama Anda?</label>
                        <input class="fs-anim-lower" id="q1" name="q1" type="text" placeholder="Nama Lengkap" required />
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q2" data-info="We won't send you spam, we promise...">Punya email?</label>
                        <input class="fs-anim-lower" id="q2" name="q2" type="email" placeholder="akunanda@email.us" required />
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q3" data-info="We won't send you spam, we promise...">Kontak aktif</label>
                        <input class="fs-anim-lower" id="q3" name="q3" type="text" placeholder="Nomor Handphone" required />
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q4">Perusahaan</label>
                        <input class="fs-anim-lower" id="q4" name="q4" type="text" placeholder="Nama Perusahaan" required />
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q5">Jabatan</label>
                        <input class="fs-anim-lower" id="q5" name="q5" type="text" placeholder="Jabatan" required />
                    </li>
                    <?php foreach ($pertanyaan->items as $key => $value) { ?>
                        <?php if ($value['jenisPertanyaan'] == "pilihan") { ?>
                            <li data-input-trigger>
                                <label class="fs-field-label fs-anim-upper" for="q<?= $key ?>" data-info="Sesuai Form Persepsi KEMENPERIN"><?= $value['namaPertanyaan'] ?></label>
                                <div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
                                    <span><input id="q<?= $key ?>b" name="a<?= $value['idPertanyaan'] ?>" type="radio" value="1" /><label for="q<?= $key ?>b" class="radio-conversion">Tidak Setuju</label></span>
                                    <span><input id="q<?= $key ?>c" name="a<?= $value['idPertanyaan'] ?>" type="radio" value="2" /><label for="q<?= $key ?>c" class="radio-social">Kurang Setuju</label></span>
                                    <span><input id="q<?= $key ?>a" name="a<?= $value['idPertanyaan'] ?>" type="radio" value="3" /><label for="q<?= $key ?>a" class="radio-mobile">Setuju</label></span>
                                    <span><input id="q<?= $key ?>d" name="a<?= $value['idPertanyaan'] ?>" type="radio" value="4" /><label for="q<?= $key ?>d" class="radio-diversion">Sangat Setuju</label></span>
                                </div>
                            </li>
                        <?php } else { ?>
                            <li>
                                <label class="fs-field-label fs-anim-upper" for="b<?= $value['idPertanyaan'] ?>"><?= $value['namaPertanyaan'] ?></label>
                                <textarea class="fs-anim-lower" id="b<?= $value['idPertanyaan'] ?>" name="b<?= $value['idPertanyaan'] ?>" placeholder="Silakan isi"></textarea>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ol><!-- /fs-fields -->
                <button class="fs-submit" type="submit" name="jawab">Send answers</button>
            </form><!-- /fs-form -->
        </div><!-- /fs-form-wrap -->

        <!-- Related demos -->
        <div class="related">
            <p>This system build by :</p>
            <img src="/assets/img/asta-02.png">
        </div>

    </div><!-- /container -->
    <script src="/assets/js/classie.js"></script>
    <script src="/assets/js/selectFx.js"></script>
    <script src="/assets/js/fullscreenForm.js"></script>
    <script>
        (function() {
            var formWrap = document.getElementById('fs-form-wrap');

            [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function(el) {
                new SelectFx(el, {
                    stickyPlaceholder: false,
                    onChange: function(val) {
                        document.querySelector('span.cs-placeholder').style.backgroundColor = val;
                    }
                });
            });

            new FForm(formWrap, {
                onReview: function() {
                    classie.add(document.body, 'overview'); // for demo purposes only
                }
            });
        })();
    </script>
</body>

</html>
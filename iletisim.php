<?php
$hata = false;
$gonder = false;
//Gönderme işleminin mevcut olup olmadığını kontrol ediyoruz.
if( isset($_POST["islem"]) && $_POST["islem"]=="gonder" ) {
	
	//Formdan gelen verilerin eksiksiz olup olmadığını kontrol ediyoruz.
	if( !empty($_POST["adsoyad"]) && !empty($_POST["email"]) && !empty($_POST["konu"]) && !empty($_POST["mesaj"]) ) {
		
		//PHPMailer
		include_once('phpmailer/class.phpmailer.php');
		
		//Ayarlar (Bu ayarlar için gerekli bilgiler kullandığınız sunucuya göre değişebilir.)
		$mail = new PHPMailer();
		$mail->isSMTP();										//SMTP Aktif
		//$mail->SMTPDebug = 1;  //Hata Gösterimi Aktif
		//$mail->SMTPSecure = 'tls';  //TLS Aktif
		$mail->SMTPAuth   = true;  //SMTP Kimlik Doğrulaması Aktif
		$mail->Host       = 'host@example.com';  //SMTP Host
		$mail->Username   = 'mail@example.com';	 //SMTP Kullanıcı Adınız
		$mail->Password   = 'password';	 //SMTP Şifreniz
		$mail->Port       = 587;  //SMTP Portu
		$mail->setFrom('mail@example.com', 'Gönderen Adı');  //Mailin Kimden Gönderildiği
		$mail->addAddress('contact@example.com', 'Alıcı Adı');	//Mailin Gönderileceği Adres (Buraya formdan gelen mesajın gönderileceği mail adresini giriniz.)
		
 		//HTML Aktif
		$mail->isHTML(true);
		$mail->CharSet ="utf-8";
		//Mail Başlığı
		$mail->Subject = 'İletişim Formu Mesajı';
		//Mail İçeriği
		$mail->Body    = '<p><strong>Gönderen:</strong> ' . $_POST["adsoyad"] . ' - ' . $_POST["email"] . '</p>'.
		'<p><strong>Konu:</strong> ' . $_POST["konu"] . '</p>'.
		'<p><strong>Mesaj:</strong> ' . $_POST["mesaj"] . '</p>';

		//Gönder
		if ( $mail->send() ) {
			$gonder = true;
		} else {
			$hata = true;
			$hata_mesaj = "Mesaj gönderilirken bir hata oluştu: ".$mail->ErrorInfo;
		}
	} else {
		$hata = true;
		$hata_mesaj = "Lütfen tüm alanları doldurun.";
	}
	
}
?>

<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <meta name="description" content="BDS">
    <meta name="keyword"
        content="LAZER, laser, epilasyon, adana, ADANA, güzel ,güzellik ,SESSİZ ,GÜÇLÜ , " />

    <!--  Title -->
    <title>BDS MEDİKAL A.Ş</title>

    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700&amp;display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />

    <!-- custom styles (optional) -->
    <link href="assets/css/plugins.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body class="v-light hamburger-menu dsn-effect-scroll dsn-ajax" data-dsn-mousemove="true">
<div data-dsn-temp="light"></div>
<div class="preloader">
    <div class="preloader-after"></div>
    <div class="preloader-before"></div>
    <div class="preloader-block">
        <div class="title">BDS MEDİKAL A.Ş</div>
        <div class="percent">0</div>
        <div class="loading">Yükleniyor...</div>
    </div>
    <div class="preloader-bar">
        <div class="preloader-progress"></div>
    </div>
</div>
	<div class="container">
		<h1>PHP İletişim Formu</h1>
		
		<?php if ($gonder) { ?>
		<div class="alert alert-success">Mesajınız başarıyla gönderildi.</div>
		<?php } ?>
		
		<?php if ($hata) { ?>
		<div class="alert alert-warning"><?php echo $hata_mesaj; ?></div>
		<?php } ?>
		
		<form method="POST" action="">
			<div class="form-group">
				<label for="adsoyad">Ad Soyad</label>
				<input type="text" class="form-control" name="adsoyad" id="adsoyad" required>
			</div>
			<div class="form-group">
				<label for="email">E-Posta</label>
				<input type="email" class="form-control" name="email" id="email" required>
			</div>
			<div class="form-group">
				<label for="konu">Konu</label>
				<input type="text" class="form-control" name="konu" id="konu" required>
			</div>
			<div class="form-group">
				<label for="mesaj">Mesaj</label>
				<textarea class="form-control" name="mesaj" id="mesaj" rows="3" required></textarea>
			</div>
			<input type="hidden" name="islem" value="gonder" required>
			<button type="submit" class="btn btn-primary">Gönder</button>
		</form>
	</div>
	
	<footer class="footer">
          <div class="container">
              <div class="footer-links p-relative">
                  <div class="row">
                      <div class="col-md-3 dsn-col-footer">
                          <div class="footer-block">
                              <div class="footer-logo">
                                  <a href="#"><img src="assets/img/logo-dark.png" alt=""></a>
                              </div>

                              <div class="footer-social">

                                  <ul>
                                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                      <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>

                                  </ul>

                              </div>
                          </div>
                      </div>

                      <div class="col-md-3 dsn-col-footer">
                          <div class="footer-block col-menu">
                              <h4 class="footer-title">Hızlı Linkler</h4>
                              <nav>
                                  <ul>
                                      <li><a href="about.html">Hakkımızda</a>
                                      </li>
                                      <li><a href="contact.html">İletişim</a></li>
                                      <li><a href="index-2.html">Anasayfa</a></li>
                                      <li><a href="diogold.html">DioGold </a>
                                      </li>
                                      <li><a href="multi.html">Multi Ipl </a>
                                      </li>
                                  </ul>
                              </nav>
                          </div>
                      </div>

                      <div class="col-md-3 dsn-col-footer">
                          <div class="footer-block col-contact">
                              <h4 class="footer-title">İletişim</h4>
                              <p><strong>Teknik Servis</strong> <span>:</span> <a href="tel:+905303072644">05303072644</a> </p>
                              <p><strong>Ofis</strong> <span>:</span><a href="tel:+905337314424">+905337314424  "Barış Avcı"</a></p>
                              <p class="over-hidden"><strong>Email</strong> <span>:</span><a class="link-hover"
                                      data-hover-text="iletisim@bdsmedikal.com" href="mailto:iletisim@bdsmedikal.com">iletisim@bdsmedikal.com</a>
                              </p>
                          </div>
                      </div>

                      <div class="col-md-3 dsn-col-footer">
                          <div class="col-address">
                              <h4 class="footer-title">Adres</h4>

                              <p>Cemalpaşa Mah. 63005 Sok. Aydınoğlu İşmerkezi
                                  No:27/21 Kat:2 Daire: 4-5 Seyhan ADANA
                                  </p>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="copyright">
                  <div class="text-center">
                      <p>© 2022 BDS MEDİKAL Güzelik Teknolojileri A.Ş</p>
                      <div class="copright-text over-hidden">Tasarım  <a class="link-hover"
                              data-hover-text="DSN Grid" href="https://wa.me/message/BWTG7XZRGSTMI1" target="_blank">AirBYTE</a>
                      </div>
                  </div>
              </div>
          </div>
      </footer>
      </div>
    </div>
  </main>

  <!-- Wait Loader -->
  <div class="wait-loader">
    <div class="loader-inner">
      <div class="loader-circle">
        <div class="loader-layer"></div>
      </div>
    </div>
  </div>
  <!-- // Wait Loader -->


  <!-- cursor -->
  <div class="cursor">

    <div class="cursor-helper cursor-view">
      <span>Görüntüle</span>
    </div>

    <div class="cursor-helper cursor-close">
      <span>Kapat</span>
    </div>

    <div class="cursor-helper cursor-link"></div>
  </div>
  <!-- End cursor -->

  <!-- Optional JavaScript -->
  <script src="assets/js/jquery-3.1.1.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/dsn-grid.js"></script>

  <script src="assets/js/custom.js"></script>
  <script type="text/javascript">

    var title = document.title;
    var sayi = 0;
    var dur = 0;
    window.onblur = function cek() {
        if (dur == 1) { dur = 0; return; }
        dur = 0;
        sayi++;
        if (sayi >= 6) {
            sayi = 0;
            cek();
        }
        else {
            if (sayi == 1) {
                document.title = "Daha etkili | BDS ";
            } else if (sayi == 2) {
                document.title = "Daha Güçlü | BDS ";
            } else if (sayi == 3) {
                document.title = "Daha BİLGİLİ | BDS";
            } else if (sayi == 4) {
                document.title = "Daha ARAŞTIRMACI  | BDS";
            } else if (sayi == 5) {
                document.title = "Daha Teknolojik | BDS";
            }
            setTimeout(cek, 1500);
        }
    };
    window.onfocus = function () {
        dur = 1;
        document.title = title;
    };
</script>  <script type="text/javascript">
  (function () {
      var options = {
          whatsapp: "905307642080", // WhatsApp numarası
          call_to_action: "Merhaba, nasıl yardımcı olabilirim?", // Görüntülenecek yazı
          position: "right", // Sağ taraf için 'right' sol taraf için 'left'
      };
      var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
      var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
      s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
      var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
  })();
</script>


</body>

</html>
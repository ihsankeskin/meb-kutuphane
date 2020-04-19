-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Haz 2019, 21:49:57
-- Sunucu sürümü: 10.1.37-MariaDB
-- PHP Sürümü: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kutuphane`
--

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `baglantili_kitaplar`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `baglantili_kitaplar` (
`kitap_id` int(11)
,`kitap_isbn_no` bigint(13)
,`kitap_ad` varchar(255)
,`kitap_yayin_evi` varchar(255)
,`kitap_yil` int(11)
,`kitap_odunc_durum` int(11)
,`kitap_adres` varchar(255)
,`kitap_yazar_id` int(11)
,`yazar_ad_soyad` varchar(255)
,`kitap_kategori_id` int(11)
,`kategori_isim` varchar(255)
,`kitap_birim_id` varchar(255)
,`birim_adi` varchar(255)
);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birimler`
--

CREATE TABLE `birimler` (
  `id` int(11) NOT NULL,
  `birimadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `iletisim` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `birimler`
--

INSERT INTO `birimler` (`id`, `birimadi`, `adres`, `iletisim`) VALUES
(9, 'ahmet kanatlı lisesi', 'kütahya yolu', 'tel no'),
(13, 'sami sipahi iöo', 'gökmeydan mahallesi', 'iletişim num'),
(14, 'bolu bursa okulu 2', 'adres yok', 'ile. no'),
(15, 'tayfun erbilen io', 'doktorlar caddesi', 'iletisim numara'),
(16, 'tavşanlı meslek yüksek okulu', 'adres', 'asdddddd'),
(18, 'fatih sultan mehmet', 'atatürk caddesi eski stadyum ilerisi', 'tel num'),
(19, 'zzzz', 'contra', 'tel no'),
(20, 'sabiha gökçen teml', 'kütahya caddesi cami karşısı', 'iletisim no'),
(21, 'qwwwwwww', 'qweq qweqqqq', '1827836 1923');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `kategori_isim` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategori_isim`) VALUES
(1, 'Akademik'),
(2, 'Bilgisayar'),
(3, 'Hobi'),
(4, 'Hukuk'),
(5, 'Edebiyat'),
(6, 'Felsefe'),
(7, 'Yemek Kitapları'),
(8, 'Fantastik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitaplar`
--

CREATE TABLE `kitaplar` (
  `id` int(11) NOT NULL,
  `ISBN_no` bigint(13) NOT NULL,
  `kitap_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yayin_evi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yili` int(11) NOT NULL,
  `odunc_durum` int(11) NOT NULL,
  `adres` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yazar_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `birim_id` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kitaplar`
--

INSERT INTO `kitaplar` (`id`, `ISBN_no`, `kitap_ad`, `yayin_evi`, `yili`, `odunc_durum`, `adres`, `yazar_id`, `kategori_id`, `birim_id`) VALUES
(1, 9573567893645, 'narnia günlükleri', 'beyaz yayınları', 2012, 0, '', 9, 8, '16'),
(3, 3333333333333, 'Şu Çılgın TÜRKLER', 'bilgi yayınevi', 2016, 1, 'okul adresi', 8, 5, '18'),
(4, 1745698512365, 'Herkes Yemek Yapabilir', 'Lezziz Lezzetler Yayınları', 2018, 2, 'okul adresi', 6, 7, '18'),
(6, 1745698512365, 'Dünya Yemekleri', 'sdf', 2342, 2, 'okul adresi', 10, 7, '18'),
(7, 1111111111111, 'Gümüş Sandalye', 'hobi dünyası', 2001, 0, 'okul adresi', 1, 3, '18'),
(8, 1092383123123, 'Siyah Giyen Adamlar', 'meninblack', 2009, 0, 'okul adresi', 9, 8, '18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odunc`
--

CREATE TABLE `odunc` (
  `id` int(11) NOT NULL,
  `ogrid` int(11) NOT NULL,
  `kitapid` int(11) NOT NULL,
  `alistarih` date NOT NULL,
  `teslimtarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `tcno` bigint(11) NOT NULL,
  `sifre` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` bigint(10) NOT NULL,
  `eposta` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `birim_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`id`, `ad`, `soyad`, `tcno`, `sifre`, `telefon`, `eposta`, `birim_id`) VALUES
(1, 'recep', 'uzun', 17912005016, 'pass89', 1791200501, 'recep@gmail.com', 18),
(3, 'recep', 'kısa', 17912005010, 'sssss', 1456352456, 'kisarec@gmail.com', 18),
(4, 'engin', 'böcü', 17912005013, 'lunapark09', 5453192741, 'enqin991@gmail.com', 18),
(5, 'ahmet', 'kılıç', 14234556732, 'oyuncu89', 4354123456, 'qe13@gmail.com', 18),
(7, 'uzay', 'gemisi', 33333331231, 'sifre12333', 5412341222, 'daddaddas@gmail.com', 18),
(8, 'osman', 'adam', 31234156344, 'asd14', 5436547545, 'ossssman@gmail.com', 20),
(9, 'elif', 'kalkan', 23141231231, 'neyyok', 5467829912, 'ellll@gmail.com', 20);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazarlar`
--

CREATE TABLE `yazarlar` (
  `id` int(11) NOT NULL,
  `yazaradsoyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yazarlar`
--

INSERT INTO `yazarlar` (`id`, `yazaradsoyad`) VALUES
(1, 'Orhan Veli'),
(2, 'Aziz Nesin'),
(4, 'Melih Cevdet Anday'),
(5, 'Faruk Nafiz Çamlıbel'),
(6, 'Canan Tan'),
(8, 'Kemal Tahir'),
(9, 'Clive Staples Lewis'),
(10, 'Turgut Özakman ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yetki_bilgi`
--

CREATE TABLE `yetki_bilgi` (
  `yetki` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yetki_bilgi`
--

INSERT INTO `yetki_bilgi` (`yetki`, `aciklama`) VALUES
('1', 'root'),
('2', 'müdür'),
('3', 'öğretmen'),
('0', 'öğrenci');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `tcno` bigint(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` bigint(11) NOT NULL,
  `eposta` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `birim_id` int(11) NOT NULL,
  `yetki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `ad`, `soyad`, `tcno`, `username`, `sifre`, `telefon`, `eposta`, `birim_id`, `yetki`) VALUES
(2, 'fatih', 'kara', 67829965712, 'ogr.admin01', 'sifre123', 5456192741, 'fatih_hoca_@gmail.com', 18, 3),
(3, 'as', 'dss', 34343333333, 'rtt.admin01', 'sifre123', 22222222222, 'adqw@asd.com', 0, 1),
(4, 'Fatih', 'Yıldırım', 17892887682, 'fatih_bey', 'ffffff', 5453192741, 'enqin991@gmail.com', 16, 2),
(5, 'Engin', 'Böcü', 12333333333, 'mdr.admin01', 'sifre123', 3242333333, 'enqin991@gmail.com', 18, 2),
(6, 'ned', 'stark', 14141111245, 'winteriscoming78', 'winter78', 5456214444, 'onuc@gmail.com', 13, 2),
(9, 'cüneyt', 'arkın', 34564444444, 'kara_murat_18', 'asparagas', 3456363434, 'cuneyt_arkin@gmail.com', 19, 2),
(10, 'mustafa', 'sandal', 45678903456, 'm.sandal', 'sifre123', 5557681122, 'sandal@gmail.com', 18, 3),
(11, 'rıfkı', 'yazan', 89028767891, 'rifki_yazan', 'sifre123', 5647896578, 'rifki_yazan@gmail.com', 20, 3),
(16, 'massaka', 'alman', 12345612344, 'diablo_63', 'sifre123', 6666666666, 'massaka_diablo@gmail.com', 18, 3);

-- --------------------------------------------------------

--
-- Görünüm yapısı `baglantili_kitaplar`
--
DROP TABLE IF EXISTS `baglantili_kitaplar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `baglantili_kitaplar`  AS  select `kitaplar`.`id` AS `kitap_id`,`kitaplar`.`ISBN_no` AS `kitap_isbn_no`,`kitaplar`.`kitap_ad` AS `kitap_ad`,`kitaplar`.`yayin_evi` AS `kitap_yayin_evi`,`kitaplar`.`yili` AS `kitap_yil`,`kitaplar`.`odunc_durum` AS `kitap_odunc_durum`,`kitaplar`.`adres` AS `kitap_adres`,`kitaplar`.`yazar_id` AS `kitap_yazar_id`,`yazarlar`.`yazaradsoyad` AS `yazar_ad_soyad`,`kitaplar`.`kategori_id` AS `kitap_kategori_id`,`kategoriler`.`kategori_isim` AS `kategori_isim`,`kitaplar`.`birim_id` AS `kitap_birim_id`,`birimler`.`birimadi` AS `birim_adi` from (((`kitaplar` join `yazarlar` on((`kitaplar`.`yazar_id` = `yazarlar`.`id`))) join `kategoriler` on((`kitaplar`.`kategori_id` = `kategoriler`.`id`))) join `birimler` on((`kitaplar`.`birim_id` = `birimler`.`id`))) ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `birimler`
--
ALTER TABLE `birimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kitaplar`
--
ALTER TABLE `kitaplar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `odunc`
--
ALTER TABLE `odunc`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcno` (`tcno`);

--
-- Tablo için indeksler `yazarlar`
--
ALTER TABLE `yazarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yoneticiler`
--
ALTER TABLE `yoneticiler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `birimler`
--
ALTER TABLE `birimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `kitaplar`
--
ALTER TABLE `kitaplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `odunc`
--
ALTER TABLE `odunc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `yazarlar`
--
ALTER TABLE `yazarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `yoneticiler`
--
ALTER TABLE `yoneticiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

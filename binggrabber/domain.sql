-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2021 pada 21.26
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binggrab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `domain`
--

CREATE TABLE `domain` (
  `list` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `domain`
--

INSERT INTO `domain` (`list`) VALUES
('2016.export.gov'),
('21cineplex.com'),
('adb.org'),
('aimindonesia.dephub.go'),
('aljazeera.com'),
('allpack-indonesia.com'),
('animebatch.web'),
('antaranews.com'),
('aseanapol.org'),
('asia-basket.com'),
('asiafoundation.org'),
('asianinfo.org'),
('atsiri-indonesia.com'),
('aux-indonesia.com'),
('bali.com'),
('bbc.com'),
('bi.go'),
('bilaterals.org'),
('blog-indonesia.com'),
('boiindonesia.co'),
('bola.com'),
('bps.go'),
('bri.co.id'),
('britannica.com'),
('brookings.edu'),
('centralindonesia.co'),
('cgv.id'),
('channelnewsasia.com'),
('cmalliance.org'),
('colliers.com'),
('conferencealerts.com'),
('conservation.org'),
('countrycallingcodes.com'),
('dailymail.co'),
('data.oecd.org'),
('data.worldbank.org'),
('detik.com'),
('dfat.gov'),
('dmt-indonesia.co'),
('doingbusiness.org'),
('edi-indonesia.co.id'),
('ems.posindonesia.co'),
('en.indonesia.nl'),
('en.unesco.org'),
('en.wikipedia.org'),
('endeavorindonesia.org'),
('esriindonesia.co.id'),
('euromonitor.com'),
('expat.or'),
('factretriever.com'),
('fao.org'),
('fi.wikipedia.org'),
('fitchratings.com'),
('floodlist.com'),
('foodbycountry.com'),
('gbgindonesia.com'),
('ge.com'),
('gem-indonesia.net'),
('geographia.com'),
('globalpropertyguide.com'),
('globalsources.com'),
('google.co'),
('google.com'),
('gov.uk'),
('granula-indonesia.blogspot.com'),
('greenpeace.org'),
('greenschool.org'),
('haywardindonesia.com'),
('henkel.co'),
('hero.co.id'),
('history.state.gov'),
('hotelindonesiagroup.co'),
('hotels.com'),
('hrw.org'),
('hydrocolloid-indonesia.com'),
('iblindonesia.com'),
('ice-indonesia.com'),
('id.msi.com'),
('id.undp'),
('id.wikipedia.org'),
('id.yahoo.com'),
('idc.co'),
('idn.sika.com'),
('idx.co.id'),
('iia-indonesia.org'),
('iix.net'),
('independent.co'),
('indexmundi.com'),
('indo.com'),
('indogamers.com'),
('indonesia-investments.com'),
('indonesia.chevron.com'),
('indonesia.cochrane.org'),
('indonesia.go.id'),
('indonesia.hu'),
('indonesia.iom.int'),
('indonesia.liverpoolfc.com'),
('indonesia.travel'),
('indonesia.tripcanvas.co'),
('indonesia.un.org'),
('indonesia.wcs.org'),
('indonesia.wetlands.org'),
('indonesia.windprospecting.com'),
('indonesiaatmelbourne.unimelb.edu'),
('indonesiacarterminal.co'),
('indonesiaetc.com'),
('indonesiaeximbank.go'),
('indonesiamedia.com'),
('indonesianews.net'),
('indonesianleadership.org'),
('indonesiaprojects.co.id'),
('indonesien.ahk.de'),
('infoplease.com'),
('insideindonesia.org'),
('instagram.com'),
('irs.gov'),
('its-indonesia.com'),
('jgc-indonesia.com'),
('jiexpo.com'),
('jpmorgan.com'),
('justlanded.com'),
('kbi.co'),
('kempinski.com'),
('kl.wikipedia.org'),
('kompas.com'),
('livinginindonesiaforum.org'),
('localhistories.org'),
('lonelyplanet.com'),
('loreal.com'),
('lpem.org'),
('manufacturingindonesia.com'),
('maphill.com'),
('maps.google.co'),
('mapsofworld.com'),
('mediaindonesia.com'),
('mizuhobank.co'),
('mpi-indonesia.co'),
('ms.wikipedia.org'),
('nukote-indonesia.com'),
('ojk.go'),
('opendoorsusa.org'),
('peacecorps.gov'),
('perpusnas.go'),
('plan-international.org'),
('play.google.com'),
('playstation.com'),
('plazaindonesia.com'),
('posindonesia.co'),
('pullmanjakartaindonesia.com'),
('python.or'),
('rainforests.mongabay.com'),
('rattan.my.id'),
('ray-ban.com'),
('reddit.com'),
('reliefweb.int'),
('scmp.com'),
('senayancity.com'),
('simple.wikipedia.org'),
('sky.co'),
('startupranking.com'),
('state.gov'),
('streetdirectory.co'),
('suaramerdeka.com'),
('support.hp.com'),
('svi-indonesia.com'),
('tanahair.indonesia.go'),
('tatamotors.co'),
('techcrunch.com'),
('techinasia.com'),
('teknisi-indonesia.com'),
('telkom.co'),
('thebrokebackpacker.com'),
('theindonesiachannel.com'),
('topuniversities.com'),
('trans7.co'),
('transparency.org'),
('travel.detik.com'),
('travel.gc.ca'),
('travel.state.gov'),
('travelindo.com'),
('tribunnews.com'),
('tripadvisor.com'),
('tripadvisor.in'),
('tsujikawa-indonesia.co.id'),
('tvsmotor.co'),
('ui.ac'),
('uii.ac'),
('umm.ac'),
('unglobalcompact.org'),
('unicef.org'),
('usaid.gov'),
('usasean.org'),
('usc-indonesia.co.id'),
('usembassy.gov'),
('usnews.com'),
('volcanodiscovery.com'),
('weather-forecast.com'),
('wenr.wes.org'),
('wepa-db.net'),
('wfp.org'),
('wikitravel.org'),
('worldatlas.com'),
('worldbank.org'),
('worldnomads.com'),
('worldometers.info'),
('worldtravelguide.net'),
('wri.org'),
('wwitv.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`list`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

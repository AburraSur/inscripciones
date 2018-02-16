ALTER TABLE `evento` CHANGE `respon` `respon` VARCHAR(100) NOT NULL;

UPDATE `evento` SET respon='Eventos CCAS' WHERE `respon`=1;

UPDATE `evento` SET respon='UCI CCAS' WHERE `respon`=2;

UPDATE `evento` SET mailresp='eventos@ccas.org.co' WHERE respon='Eventos CCAS';